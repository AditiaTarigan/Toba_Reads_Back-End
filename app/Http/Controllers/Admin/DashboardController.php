<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data statistik
        $totalUser = User::count();
        // $totalBuku = \App\Models\Buku::count();

        return view('admin.dashboard', compact('totalUser'));
    }
}
