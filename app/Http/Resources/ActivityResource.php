<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
          'activity_name' => $this->activity_name,
          'activity_date' => $this->activity_date,
          'activity_time' => $this->activity_time,
          'fines' => $this->fines,
          'semester' => $this->semester,
          'school_year' => $this->school_year,
          'schoolyear_id' => $this->schoolyear_id,
          'created_at' => $this->created_at->toDateTimeString(),
          'updated_at' => $this->updated_at->toDateTimeString(),
          'per_page' => $this->per_age
      ];
    }
}
