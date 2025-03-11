<?php

namespace App\Http\Requests\Students\Fees;

use Illuminate\Foundation\Http\FormRequest;

class DeleteFees extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من أن المستخدم لديه الصلاحية لحذف الرسوم
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:fees,id', // يجب أن يكون الـ ID موجودًا في جدول الرسوم
        ];
    }

    /**
     * Custom error messages
     */
    public function messages()
    {
        return [
            'id.required' => 'يجب تحديد الرسوم الدراسية.',
            'id.exists' => 'الرسوم الدراسية غير موجودة في النظام.',
        ];
    }
}