<?php

namespace App\Http\Requests\Parents\dashboard\Children;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildrenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,' . $this->route('id'),
            'password' => 'sometimes|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب إدخال اسم الطالب.',
            'email.required' => 'يجب إدخال البريد الإلكتروني.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'يجب إدخال كلمة المرور.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
        ];
    }
}
