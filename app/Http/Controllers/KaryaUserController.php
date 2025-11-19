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

    public function store(Request $request)
    {
        $request->validate([
            'id_user'=>'required',
            'judul'=>'required',
            'isi'=>'required'
        ]);

        return KaryaUser::create($request->all());
    }
}
