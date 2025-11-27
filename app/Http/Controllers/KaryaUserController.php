<?php

namespace App\Http\Controllers;

use App\Models\KaryaUser;
use Illuminate\Http\Request;

class KaryaUserController extends Controller
{
    public function index()
    {
        return KaryaUser::with('user')->get();
    }

    // di app/Http/Controllers/KaryaUserController.php
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $karya = new KaryaUser();
            $karya->judul = $request->judul;
            $karya->isi = $request->isi;
            $karya->id_user = $request->id_user; // Langsung dari Flutter
            $karya->status = 'diterima'; // LANGSUNG APPROVED

            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar')->store('karya_images', 'public');
                $karya->gambar = $imagePath;
            }

            $karya->save();

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
