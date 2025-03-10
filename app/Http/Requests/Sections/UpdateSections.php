<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSections extends FormRequest
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
}
