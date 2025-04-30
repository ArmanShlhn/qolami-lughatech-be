<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\PasswordResetMail;
class AuthController extends Controller
{
    #register
    public function register(Request $request){
        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request->password)
        ]);
        
        $token = $user->createToken('apitodos')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    #login
    public function login(Request $request) {
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
            'user' => $user,
            'token' => $user->createToken('apitodos')->plainTextToken
        ]);
    }
    #logout
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'kamu berhasil logout']);
    }

    #reset password via email (lokal) postman
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users,email',]);

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
