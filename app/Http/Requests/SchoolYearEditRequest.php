<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolYearEditRequest extends FormRequest
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
          'school_year' => 'required|unique:school_year,school_year,'.$this->id
         ];
     }

     public function messages()
     {
       return [
         'school_year.required' => 'School year is required!',
         'school_year.unique' => 'School year has already been taken!',
       ];
     }
}
