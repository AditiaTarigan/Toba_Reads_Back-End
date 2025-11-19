<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use Illuminate\Http\Request;

class HasilKuisController extends Controller
{
    public function store(Request $request)
    {
        return HasilKuis::create($request->all());
    }

    public function history($id_user)
    {
        return HasilKuis::with('kuis')->where('id_user', $id_user)->get();
    }
}
