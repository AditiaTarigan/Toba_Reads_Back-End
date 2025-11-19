<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index()
    {
        return Kuis::all();
    }

    public function show($id)
    {
        return Kuis::with('soal')->findOrFail($id);
    }

    public function store(Request $request)
    {
        return Kuis::create($request->all());
    }
}
