<?php

namespace App\Http\Requests\Students\FeesInvoices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeesInvoices extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من أن المستخدم لديه الصلاحية لإنشاء فاتورة الرسوم
    }

    /**
     * Get the validation rules that apply to the request.
     */

     public function rules(): array
     {
         return [
             'title.en' => 'required|string',
             'title.ar' => 'required|string',
             'amount' => 'required|numeric',
             'Grade_id' => 'required|integer',
             'Classroom_id' => 'required|integer',
             'year' => 'required|string',
             'description' => 'nullable|string',
             'Fee_type' => 'required|string',
             'student_id' => 'required|integer',  // تأكد من وجود هذه القاعدة
             'fee_id' => 'required|integer',
             'section_id' => 'required|integer',
         ];
     }
    

    /**
     * Custom error messages
     */
    public function messages()
    {
        return [
            'title.en.required' => 'يجب إدخال عنوان الفاتورة باللغة الإنجليزية.',
            'title.ar.required' => 'يجب إدخال عنوان الفاتورة باللغة العربية.',
            'amount.required' => 'يجب إدخال المبلغ.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقمًا.',
            'Grade_id.required' => 'يجب تحديد المرحلة الدراسية.',
            'Classroom_id.required' => 'يجب تحديد الصف الدراسي.',
            'year.required' => 'يجب إدخال السنة الدراسية.',
            'Fee_type.required' => 'يجب تحديد نوع الرسوم.',
            'student_id.required' => 'يجب تحديد الطالب.',
            'fee_id.required' => 'يجب تحديد الرسوم.',
            'section_id.required' => 'يجب تحديد القسم.', // إضافة رسالة لـ section_id
        ];
    }
}
