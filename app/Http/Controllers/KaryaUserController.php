<?php

namespace App\Http\Controllers;

use App\Models\KaryaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryaUserController extends Controller
{
    public function index()
    {
        $karya = KaryaUser::with('user')->get();

        $karya->map(function ($item) {
            if ($item->file_lampiran) {
                $item->gambar_url = asset('storage/' . $item->file_lampiran);
            } else {
                $item->gambar_url = null;
            }
            return $item;
        });

        return $karya;
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $karya = new KaryaUser();
            $karya->judul = $request->judul;
            $karya->isi = $request->isi;
            $karya->id_user = $request->id_user;
            $karya->status = 'diterima';

            if ($request->hasFile('file_lampiran')) {
                $filename = time() . '_' . $request->file('file_lampiran')->getClientOriginalName();
                $path = $request->file('file_lampiran')->storeAs('karya_images', $filename, 'public');
                $karya->file_lampiran = $path;
            }

            $karya->save();
            $karya->load('user');

            $karya->gambar_url = $karya->file_lampiran
                ? asset('storage/' . $karya->file_lampiran)
                : null;

            return response()->json([
                'success' => true,
                'message' => 'Karya berhasil diupload',
                'data' => $karya
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload karya: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $karya = KaryaUser::findOrFail($id);
            $karya->judul = $request->judul;
            $karya->isi = $request->isi;

            if ($request->hasFile('file_lampiran')) {
                if ($karya->file_lampiran && Storage::disk('public')->exists($karya->file_lampiran)) {
                    Storage::disk('public')->delete($karya->file_lampiran);
                }

                $filename = time() . '_' . $request->file('file_lampiran')->getClientOriginalName();
                $path = $request->file('file_lampiran')->storeAs('karya_images', $filename, 'public');
                $karya->file_lampiran = $path;
            } elseif ($request->has('remove_image') && $request->remove_image == 'true') {
                if ($karya->file_lampiran && Storage::disk('public')->exists($karya->file_lampiran)) {
                    Storage::disk('public')->delete($karya->file_lampiran);
                }
                $karya->file_lampiran = null;
            }

            $karya->save();
            $karya->load('user');

            $karya->gambar_url = $karya->file_lampiran
                ? asset('storage/' . $karya->file_lampiran)
                : null;

            return response()->json([
                'success' => true,
                'message' => 'Karya berhasil diperbarui',
                'data' => $karya
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update karya: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $karya = KaryaUser::findOrFail($id);

            if ($karya->file_lampiran && Storage::disk('public')->exists($karya->file_lampiran)) {
                Storage::disk('public')->delete($karya->file_lampiran);
            }

            $karya->delete();

            return response()->json([
                'success' => true,
                'message' => 'Karya berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus karya: ' . $e->getMessage()
            ], 500);
        }
    }

    // Tambahkan jika belum ada
    public function getByUser($id_user)
    {
        $karya = KaryaUser::where('id_user', $id_user)
            ->with('user')
            ->get()
            ->map(function ($item) {
                if ($item->file_lampiran) {
                    $item->gambar_url = asset('storage/' . $item->file_lampiran);
                } else {
                    $item->gambar_url = null;
                }
                return $item;
            });

        return $karya;
    }

    public function search(Request $request)
    {
        $query = KaryaUser::with('user');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                    ->orWhere('isi', 'like', "%$search%");
            });
        }

        $karya = $query->get()->map(function ($item) {
            if ($item->file_lampiran) {
                $item->gambar_url = asset('storage/' . $item->file_lampiran);
            } else {
                $item->gambar_url = null;
            }
            return $item;
        });

        return $karya;
    }
}
