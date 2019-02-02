<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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

           'student_no' => 'required|unique_with:attendance,student_no,activity_id'

       ];
     }

     public function messages()
     {
       return [
         'student_no.required' => 'Student Id is required!',
         'student_no.unique_with' => 'You have already logged in!',
       ];
     }
}
