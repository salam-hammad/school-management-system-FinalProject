<?php

namespace App\Http\Requests\Students\Fees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFees extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من أن المستخدم لديه الصلاحية لتحديث الرسوم
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $feeId = $this->route('fee'); // الحصول على معرف الرسوم من الرابط

        return [
            'title.en' => [
                'sometimes', // يمكن تحديث العنوان بالإنجليزية إذا تم إرساله
                'required',
                'string',
                'max:255',
                Rule::unique('fees', 'title->en')->ignore($feeId), // تجاهل القيمة الحالية للرسوم
            ],
            'title.ar' => [
                'sometimes', // يمكن تحديث العنوان بالعربية إذا تم إرساله
                'required',
                'string',
                'max:255',
                'regex:/^[\p{Arabic}\s]+$/u', // تحقق من النصوص العربية
            ],
            'amount' => 'sometimes|required|numeric|min:0', // يمكن تحديث المبلغ إذا تم إرساله
            'Grade_id' => 'sometimes|required|exists:grades,id', // يمكن تحديث المرحلة الدراسية إذا تم إرسالها
            'Classroom_id' => 'sometimes|required|exists:classrooms,id', // يمكن تحديث الصف الدراسي إذا تم إرساله
            'year' => 'sometimes|required|digits:4', // يمكن تحديث السنة الدراسية إذا تم إرسالها
            'description' => 'nullable|string', // الوصف اختياري
            'Fee_type' => 'sometimes|required|integer|in:1,2', // يمكن تحديث نوع الرسوم إذا تم إرساله (0 أو 1)
        ];
    }

    /**
     * Custom error messages
     */
    public function messages()
    {
        return [
            'title.en.required' => 'يجب إدخال عنوان الرسوم باللغة الإنجليزية.',
            'title.ar.required' => 'يجب إدخال عنوان الرسوم باللغة العربية.',
            'title.ar.regex' => 'يجب أن يحتوي العنوان باللغة العربية على أحرف عربية فقط.',
            'amount.required' => 'يجب إدخال المبلغ.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقمًا.',
            'Grade_id.required' => 'يجب تحديد المرحلة الدراسية.',
            'Grade_id.exists' => 'المرحلة الدراسية غير موجودة في النظام.',
            'Classroom_id.required' => 'يجب تحديد الصف الدراسي.',
            'Classroom_id.exists' => 'الصف الدراسي غير موجود في النظام.',
            'year.required' => 'يجب إدخال السنة الدراسية.',
            'Fee_type.required' => 'يجب تحديد نوع الرسوم.',
            'Fee_type.integer' => 'نوع الرسوم يجب أن يكون رقمًا.',
            'Fee_type.in' => 'نوع الرسوم يجب أن يكون: 0 (fixed) أو 1 (variable).',
        ];
    }
}