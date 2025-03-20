<?php

namespace App\Http\Requests\Parents\dashboard\Children;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildrenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'required|exists:parents,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'parent_id.required' => 'يجب تحديد ولي الأمر.',
            'parent_id.exists' => 'ولي الأمر المحدد غير موجود.',
            'name.required' => 'يجب إدخال اسم الطالب.',
            'email.required' => 'يجب إدخال البريد الإلكتروني.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'يجب إدخال كلمة المرور.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
        ];
    }
}