<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // 1. Wajib import Model Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email|max:150',
            'password' => 'required|string|min:6|max:255',
            'no_hp' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
        ]);

<<<<<<< HEAD
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
=======
        if ($validator->fails()) {
>>>>>>> 8b49cacd0caf28484b6dbb5034e1e644ba5506d5
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'bio' => $request->bio,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'role' => 'user',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil',
                'data' => [
                    'user' => $user
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registrasi gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        // 4. Load relasi role di login juga, agar Flutter tahu hak akses user ini
        $user->load('role');

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $user, // Sekarang object user akan berisi data role juga
                'token' => $token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    // Di AuthController.php
    public function profile(Request $request)
    {
        try {
            $user = $request->user(); // Menggunakan Sanctum

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:150',
            'bio' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'user' => $user
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
