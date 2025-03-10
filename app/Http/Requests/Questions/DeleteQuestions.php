<?php

namespace App\Http\Requests\Questions;

use Illuminate\Foundation\Http\FormRequest;

class DeleteQuestions extends FormRequest
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
            'id' => 'required|exists:questions,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'يجب تحديد السؤال.',
            'id.exists' => 'السؤال المحدد غير موجود.',
        ];
    }
}
