<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;

class StoreSections extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Name_Section_Ar' => 'required|string|max:255',
            'Name_Section_En' => 'required|string|max:255',
            'Grade_id' => 'required|exists:grades,id',
            'Class_id' => 'required|exists:classrooms,id',
            'teacher_id' => 'nullable|array',
            'teacher_id.*' => 'exists:teachers,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'Name_Section_Ar.required' => 'الاسم العربي للقسم مطلوب.',
            'Name_Section_En.required' => 'الاسم الإنجليزي للقسم مطلوب.',
            'Grade_id.required' => 'يجب تحديد الصف الدراسي.',
            'Grade_id.exists' => 'الصف الدراسي المحدد غير صالح.',
            'Class_id.required' => 'يجب تحديد الفصل الدراسي.',
            'Class_id.exists' => 'الفصل الدراسي المحدد غير صالح.',
            'teacher_id.*.exists' => 'المعلم المحدد غير صالح.',
        ];
    }
}
