<?php

namespace App\Http\Requests\Quizzes;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizzes extends FormRequest
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
            'Name_ar' => 'required|string|max:255',
            'Name_en' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'Grade_id' => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'Name_ar.required' => 'يجب إدخال اسم الاختبار باللغة العربية.',
            'Name_ar.string' => 'اسم الاختبار باللغة العربية يجب أن يكون نصًا.',
            'Name_ar.max' => 'اسم الاختبار باللغة العربية يجب ألا يتجاوز 255 حرفًا.',

            'Name_en.required' => 'يجب إدخال اسم الاختبار باللغة الإنجليزية.',
            'Name_en.string' => 'اسم الاختبار باللغة الإنجليزية يجب أن يكون نصًا.',
            'Name_en.max' => 'اسم الاختبار باللغة الإنجليزية يجب ألا يتجاوز 255 حرفًا.',

            'subject_id.required' => 'يجب اختيار المادة الدراسية.',
            'subject_id.exists' => 'المادة الدراسية المحددة غير موجودة.',

            'Grade_id.required' => 'يجب اختيار المرحلة الدراسية.',
            'Grade_id.exists' => 'المرحلة الدراسية المحددة غير موجودة.',

            'Classroom_id.required' => 'يجب اختيار الصف الدراسي.',
            'Classroom_id.exists' => 'الصف الدراسي المحدد غير موجود.',

            'section_id.required' => 'يجب اختيار القسم الدراسي.',
            'section_id.exists' => 'القسم الدراسي المحدد غير موجود.',

            'teacher_id.required' => 'يجب اختيار المعلم.',
            'teacher_id.exists' => 'المعلم المحدد غير موجود.',
        ];
    }
}
