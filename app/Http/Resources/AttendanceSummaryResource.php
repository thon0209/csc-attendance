<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceSummaryResource extends JsonResource
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
          'activity_name' => $this->activity_name,
          'activity_date' => $this->activity_date,
          'fines' => $this->fines 
        ];
    }
}
