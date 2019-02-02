<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolYearResource extends JsonResource
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
          'school_year' => $this->school_year
        ];
    }
}
