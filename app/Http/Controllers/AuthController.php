<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\PasswordResetMail;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    # Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('apitodos')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    # Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        }
        
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return response()->json([
            'message' => 'Login berhasil!',
            'user' => new UserResource($user),
            'token' => $user->createToken('apitodos')->plainTextToken,
        ]);
    }

    # Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Kamu berhasil logout']);
    }

    # Reset password via email (lokal)
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Email tidak ditemukan.'], 404);
        }

        $user = User::where('email', $request->email)->first();
        $username = strstr($user->email, '@', true);
        $newPassword = $username . '123';
        $user->password = bcrypt($newPassword);
        $user->save();

        Mail::to($user->email)->send(new PasswordResetMail($newPassword));

        return response()->json(['message' => 'Password baru telah dikirim ke email Anda.'], 200);
    }
}
