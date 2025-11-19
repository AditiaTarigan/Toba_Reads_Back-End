<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function index() { return Penulis::all(); }
    public function show($id) { return Penulis::findOrFail($id); }

    public function store(Request $request)
    {
        $request->validate(['nama_penulis' => 'required']);
        return Penulis::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = Penulis::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return Penulis::destroy($id);
    }
}
