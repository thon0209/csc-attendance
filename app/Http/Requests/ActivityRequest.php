<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
          'activity_name' => 'required',
          'activity_date' => 'required',
          'activity_time' => 'required',
          'schoolyear_id' => 'required',
          'fines' => 'required',
          'semester' => 'required',
      ];
    }

    public function messages()
    {
      return [
        'activity_name.required' => 'Activity is required!',
        'schoolyear_id.required' => 'School year is required!',
        'activity_date.required' => 'Date is required!',
        'activity_time.required' => 'Activity time is required!',
        'fines.required' => 'Fines is required!',
        'semester.required' => 'Semester is required!',
      ];
    }
}
