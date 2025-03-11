<?php

namespace App\Http\Requests\Students\FeesInvoices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeesInvoices extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من أن المستخدم لديه الصلاحية لتحديث فاتورة الرسوم
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $feeInvoiceId = $this->route('id'); // الحصول على معرف الفاتورة من الرابط

        return [
            'title.en' => 'sometimes|required|string|max:255', // العنوان بالإنجليزية (اختياري عند التحديث)
            'title.ar' => 'sometimes|required|string|max:255|regex:/^[\p{Arabic}\s]+$/u', // العنوان بالعربية (اختياري عند التحديث)
            'amount' => 'sometimes|required|numeric|min:0', // المبلغ (اختياري عند التحديث)
            'Grade_id' => 'sometimes|required|exists:grades,id', // المرحلة الدراسية (اختياري عند التحديث)
            'Classroom_id' => 'sometimes|required|exists:classrooms,id', // الصف الدراسي (اختياري عند التحديث)
            'year' => 'sometimes|required|digits:4', // السنة الدراسية (اختياري عند التحديث)
            'description' => 'nullable|string', // الوصف (اختياري)
            'Fee_type' => 'sometimes|required|integer|in:1,2', // نوع الرسوم (اختياري عند التحديث)
            'student_id' => 'sometimes|required|exists:students,id', // الطالب (اختياري عند التحديث)
            'fee_id' => 'sometimes|required|exists:fees,id', // الرسوم (اختياري عند التحديث)
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
            'title.ar.regex' => 'يجب أن يحتوي العنوان باللغة العربية على أحرف عربية فقط.',
            'amount.required' => 'يجب إدخال المبلغ.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقمًا.',
            'Grade_id.required' => 'يجب تحديد المرحلة الدراسية.',
            'Grade_id.exists' => 'المرحلة الدراسية غير موجودة في النظام.',
            'Classroom_id.required' => 'يجب تحديد الصف الدراسي.',
            'Classroom_id.exists' => 'الصف الدراسي غير موجود في النظام.',
            'year.required' => 'يجب إدخال السنة الدراسية.',
            'Fee_type.required' => 'يجب تحديد نوع الرسوم.',
            'Fee_type.in' => 'نوع الرسوم يجب أن يكون: 1 (ثابت) أو 2 (متغير).',
            'student_id.required' => 'يجب تحديد الطالب.',
            'student_id.exists' => 'الطالب غير موجود في النظام.',
            'fee_id.required' => 'يجب تحديد الرسوم.',
            'fee_id.exists' => 'الرسوم غير موجودة في النظام.',
        ];
    }
}