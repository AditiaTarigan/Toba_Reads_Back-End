<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index() { return KategoriBuku::all(); }
    public function show($id) { return KategoriBuku::findOrFail($id); }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required']);
        return KategoriBuku::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = KategoriBuku::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return KategoriBuku::destroy($id);
    }
}
