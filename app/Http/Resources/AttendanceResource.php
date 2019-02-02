<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'activity_id' => $this->activity_id,
        'student_no' => $this->student_no,
        'time_log' => $this->time_log,

        'student_id' => $this->student_id,
        'last_name' => $this->last_name,
        'activity_name' => $this->activity_name,
        'semester' => $this->semester ,
        'fines' => $this->fines,
        'school_year' => $this->school_year


      ];
    }
}
