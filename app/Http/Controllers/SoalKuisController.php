<?php

namespace App\Http\Controllers;

use App\Models\SoalKuis;
use Illuminate\Http\Request;

class SoalKuisController extends Controller
{
    public function store(Request $request)
    {
        return SoalKuis::create($request->all());
    }
}
