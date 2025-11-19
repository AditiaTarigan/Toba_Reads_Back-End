<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_user' => 'required',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        return Review::create($request->all());
    }

    public function destroy($id)
    {
        return Review::destroy($id);
    }
}
