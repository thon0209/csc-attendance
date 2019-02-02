<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required|unique:students,student_id',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'course' => 'required',
            'year_level' => 'required',
            'barcode' => 'unique:students,barcode'
        ];
    }

    public function messages()
    {
      return [
        
            'student_id.required' => 'Student Id is required!',
            'student_id.unique' => 'Student Id has already been taken!',

            'last_name.required' => 'Last name is required!',
            'first_name.required' => 'First name is required!',
            'middle_name.required' => 'Middle name is required!',

            'course.required' => 'Course is required!',
            'year_level.required' => 'Year Level is required!',

            'barcode.required' => 'Barcode is required!',

        ];
    }
}
