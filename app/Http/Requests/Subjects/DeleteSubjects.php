<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSubjects extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:subjects,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'يجب تحديد المادة الدراسية.',
            'id.exists' => 'المادة الدراسية المحددة غير موجودة.',
        ];
    }
}