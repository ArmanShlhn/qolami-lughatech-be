<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\PasswordResetMail;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    # Rename akun
    public function renameAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return response()->json([
            'message' => 'Nama akun berhasil diubah.',
            'user' => new UserResource($user),
        ]);
    }

    #Send otp
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = mt_rand(100000, 999999);
        $email = $request->email;

        DB::table('password_resets')->where('email', $email)->delete();

        DB::table('password_resets')->insert([
            'email' => $email,
            'code' => $otp,
            'created_at' => Carbon::now(),
        ]);

        try {
            Mail::to($email)->send(new PasswordResetMail($otp));
            return response()->json(['message' => 'Kode OTP telah dikirim ke email.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengirim email: ' . $e->getMessage()], 500);
        }
    }

    # Change password dengan otp via email
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $otpData = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('code', $request->otp_code)
            ->first();

        if (!$otpData) {
            return response()->json(['error' => 'Kode OTP salah atau tidak ditemukan.'], 400);
        }

        if (Carbon::parse($otpData->created_at)->addMinutes(10)->isPast()) {
            return response()->json(['error' => 'Kode OTP sudah kedaluwarsa.'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->new_password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password berhasil diubah.'], 200);
    }
}