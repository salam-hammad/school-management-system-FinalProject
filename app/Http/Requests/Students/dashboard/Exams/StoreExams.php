<?php

namespace App\Http\Requests\Students\dashboard\Exams;

use Illuminate\Foundation\Http\FormRequest;

class StoreExams extends FormRequest
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
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'teacher_id' => 'required|exists:teachers,id',
            'total_marks' => 'required|numeric|min:1',
            'date' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب إدخال اسم الامتحان.',
            'subject_id.required' => 'يجب تحديد المادة.',
            'grade_id.required' => 'يجب تحديد المرحلة الدراسية.',
            'classroom_id.required' => 'يجب تحديد الفصل الدراسي.',
            'section_id.required' => 'يجب تحديد القسم.',
            'teacher_id.required' => 'يجب تحديد المعلم.',
            'total_marks.required' => 'يجب إدخال العلامة الكلية.',
            'total_marks.numeric' => 'يجب أن تكون العلامة الكلية رقمية.',
            'date.required' => 'يجب إدخال تاريخ الامتحان.',
            'date.date_format' => 'يجب أن يكون تنسيق التاريخ بصيغة YYYY-MM-DD.',
        ];
    }
}