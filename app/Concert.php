<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{

    public function getConcertDateAttribute($value)
    {
        return $this->date->format('F j, Y');
    }

    public function getStartTimeAttribute($value)
    {
        return $this->date->format('g:ia');
    }

    public function getTicketPriceInEurosAttribute($value)
    {
        return number_format($this->ticket_price / 100, 2);
    }
}
