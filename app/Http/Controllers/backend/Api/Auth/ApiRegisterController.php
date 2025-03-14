<?php

namespace App\Http\Controllers\backend\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiRegisterController extends Controller
{
    /**
     * تسجيل مستخدم جديد عبر API
     */
    public function register(Request $request)
    {
        // ✅ التحقق من أن البيانات تصل بشكل صحيح
        if (!$request->isJson()) {
            return response()->json([
                'status_code' => 415,
                'message' => 'Unsupported Media Type. Please send JSON data.',
            ], 415);
        }

        // ✅ طباعة البيانات المستلمة للتحقق منها (اختياري: يمكن إزالته بعد الاختبار)
        // dd($request->all());

        // ✅ التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ✅ إذا فشل التحقق، إرجاع الأخطاء برسالة واضحة
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Validation failed. Please check your inputs.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // ✅ إنشاء المستخدم الجديد
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ✅ إرجاع رسالة نجاح مع بيانات المستخدم
        return response()->json([
            'status_code' => 201,
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
}
