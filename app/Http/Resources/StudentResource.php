<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
          'student_id' => $this->student_id,
          'last_name' => $this->last_name,
          'first_name' => $this->first_name,
          'middle_name' => $this->middle_name,
          'course' => $this->course,
          'year_level' => $this->year_level,
          'barcode' => $this->barcode,
          'created_at' => $this->created_at->toDateTimeString(),
          'updated_at' => $this->updated_at->toDateTimeString(),
          'per_page' => $this->per_age
      ];
    }
}
