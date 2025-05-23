<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
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
            // 'List_Classes.*.Name' => 'required',
            // 'List_Classes.*.Name_class_en' => 'required',        
        
            'Name' => 'required|unique:grades,name->ar,'.$this->id,
            'Name_en' => 'required|unique:grades,name->en,'.$this->id,
        ];
    }
    public function messages(){
        return[
            // 'Name.required'=>trans('validation.required'),
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
        ];
    }
}
