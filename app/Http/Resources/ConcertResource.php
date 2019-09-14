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
            "title" => $this->title,
            "slug" => $this->slug,
            "date" => $this->date,
            "city" => $this->city,
            "avenue" => $this->venue,
            "price" => $this->ticket_price,
            "itemsLeft" => $this->tickets()->available(),
        ];
    }
}
