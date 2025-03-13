<?php

namespace App\Http\Controllers\backend\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiLoginController extends Controller
{
    /**
     * تسجيل دخول API وإرجاع Access Token
     */
    public function login(Request $request)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // محاولة تسجيل الدخول
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized | بيانات تسجيل الدخول غير صحيحة',
            ], 401);
        }

        // جلب المستخدم
        $user = Auth::user();

        // إنشاء Access Token باستخدام `Sanctum` أو `Passport`
        $token = $user->createToken('API Token')->plainTextToken;

        // إرجاع التوكين للعميل
        return response()->json([
            'status_code' => 200,
            'message' => 'Login successful | تسجيل الدخول ناجح',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * تسجيل الخروج من API
     */
    public function logout(Request $request)
    {
        // حذف التوكين الخاص بالمستخدم
        $request->user()->tokens()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Logged out successfully | تم تسجيل الخروج بنجاح',
        ]);
    }
}