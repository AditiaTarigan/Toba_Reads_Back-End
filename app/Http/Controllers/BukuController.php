<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        return Buku::with(['penulis','kategori'])->get();
    }

    public function show($id)
    {
        return Buku::with(['penulis','kategori','review'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate(['judul'=>'required']);
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
}
