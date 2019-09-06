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
            "slug" => $this->slug,
            "date" => $this->date,
            "city" => $this->city,
            "avenue" => $this->venue,
            "tickets_price" => $this->ticket_price,
            "tickets_left" => $this->tickets()->available(),
        ];
    }
}
