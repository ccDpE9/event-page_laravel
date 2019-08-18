<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
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
            "date" => $this->date,
            "city" => $this->city,
            "avenue" => $this->avenue,
            "tickets_price" => $this->tickets_price,
        ];
    }
}
