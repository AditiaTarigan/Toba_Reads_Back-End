<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Semua user
    public function index()
    {
        return User::all();
    }

    // Detail user
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json(['success' => true, 'data' => $user]);
    }

    // Delete user
    public function destroy($id)
    {
        User::destroy($id);
        return ['success' => true];
    }
    public function getByNama($nama)
    {
        $user = User::where('nama', $nama)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
}
