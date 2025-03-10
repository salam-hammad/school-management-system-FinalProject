<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrades extends FormRequest
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
            'Name' => 'required|string|max:255',
            'Name_en' => 'required|string|max:255',
            'Notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'يجب إدخال اسم المرحلة الدراسية باللغة العربية.',
            'Name_en.required' => 'يجب إدخال اسم المرحلة الدراسية باللغة الإنجليزية.',
        ];
    }
}
