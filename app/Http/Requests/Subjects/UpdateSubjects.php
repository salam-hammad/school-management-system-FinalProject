<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjects extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Name_Ar' => 'required|string|max:255',
            'Name_En' => 'required|string|max:255',
            'Grade_id' => 'required|exists:grades,id',
            'Teacher_id' => 'required|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'Name_Ar.required' => 'يجب إدخال اسم المادة الدراسية باللغة العربية.',
            'Name_En.required' => 'يجب إدخال اسم المادة الدراسية باللغة الإنجليزية.',
            'Grade_id.required' => 'يجب تحديد المرحلة الدراسية.',
            'Grade_id.exists' => 'المرحلة الدراسية غير موجودة.',
            'Teacher_id.required' => 'يجب تحديد المعلم للمادة.',
            'Teacher_id.exists' => 'المعلم غير موجود.',
        ];
    }
}
