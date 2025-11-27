<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        return Buku::with(['penulis', 'kategori'])->get();
    }

    public function show($id)
    {
        return Buku::with(['penulis', 'kategori', 'review'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate(['judul' => 'required']);
        return Buku::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = Buku::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return Buku::destroy($id);
    }

    public function lastRead($id_user)
    {
        $history = DB::table('riwayat_baca')
            ->join('buku', 'riwayat_baca.id_buku', '=', 'buku.id')
            ->where('riwayat_baca.id_user', $id_user)
            ->orderBy('riwayat_baca.updated_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json($history);
    }

    public function storeLastRead(Request $request)
    {
        DB::table('riwayat_baca')->updateOrInsert(
            [
                'id_user' => $request->id_user,
                'id_buku' => $request->id_buku,
            ],
            ['updated_at' => now()]
        );

        return response()->json(['message' => 'Riwayat diperbarui']);
    }
}
