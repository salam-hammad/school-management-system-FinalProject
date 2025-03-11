<?php

namespace App\Http\Requests\Students\FeesInvoices;

use Illuminate\Foundation\Http\FormRequest;

class DeleteFeesInvoices extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من أن المستخدم لديه الصلاحية لحذف فاتورة الرسوم
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:fee_invoices,id', // يجب أن يكون الـ ID موجودًا في جدول فواتير الرسوم
        ];
    }

    /**
     * Custom error messages
     */
    public function messages()
    {
        return [
            'id.required' => 'يجب تحديد فاتورة الرسوم.',
            'id.exists' => 'فاتورة الرسوم غير موجودة في النظام.',
        ];
    }
}
