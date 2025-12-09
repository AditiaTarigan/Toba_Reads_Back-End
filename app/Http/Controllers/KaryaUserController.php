<?php

namespace App\Http\Controllers;

use App\Models\KaryaUser;
use Illuminate\Http\Request;

class KaryaUserController extends Controller
{
    public function index()
    {
        $karya = KaryaUser::with('user')->get();

        // Tambahkan URL gambar penuh
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

    // di app/Http/Controllers/KaryaUserController.php
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

            // LOAD RELASI USER SEBELUM RETURN
            $karya->load('user');

            // URL gambar
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
}
