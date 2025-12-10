<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // 1. Wajib import Model Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'nullable|string|max:20'
        ]);

        // 2. Cari ID milik role 'user' di database
        $roleUser = Role::where('nama_role', 'user')->first();

        // Safety check: Jika belum di-seed, berikan pesan error yang jelas
        if (!$roleUser) {
            return response()->json([
                'success' => false,
                'message' => 'Role "user" tidak ditemukan. Jalankan RoleSeeder terlebih dahulu.',
            ], 500);
        }

        // 3. Masukkan role_id ke dalam create user
        $user = User::create([
            'role_id' => $roleUser->id, // <--- Perubahan di sini (ambil ID dari hasil query)
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_hp' => $validated['no_hp'] ?? null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // Opsional: Load data role agar dikirim ke Flutter (biar tahu dia role apa)
        $user->load('role');

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
                'data' => null
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Load relasi role di login juga, agar Flutter tahu hak akses user ini
        $user->load('role');

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user, // Sekarang object user akan berisi data role juga
                'token' => $token
            ]
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful',
            'data' => null
        ], 200);
    }
}
