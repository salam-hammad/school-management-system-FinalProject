<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class DeleteGrades extends FormRequest
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
            'id' => 'required|exists:grades,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'يجب تحديد المرحلة الدراسية.',
            'id.exists' => 'المرحلة الدراسية المحددة غير موجودة.',
        ];
    }
}
