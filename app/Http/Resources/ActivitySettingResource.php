<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivitySettingResource extends JsonResource
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
        'activity_name' => $this->activity_name,
        'activity_date' => $this->activity_date,
        'school_year' => $this->school_year,
        'activity_time' => $this->activity_time,
        'semester' => $this->semester
      ];
    }
}
