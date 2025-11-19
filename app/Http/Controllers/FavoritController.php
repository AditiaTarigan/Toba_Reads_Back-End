<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    public function indexByUser($id_user)
    {
        return Favorit::with('buku')->where('id_user', $id_user)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_buku' => 'required',
        ]);

        return Favorit::create($request->all());
    }

    public function destroy($id)
    {
        return Favorit::destroy($id);
    }
}
