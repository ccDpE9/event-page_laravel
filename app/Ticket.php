<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function concert()
    {
        $this->belongsTo('App\Concert');
    }

    public function order()
    {
        $this->belongsTo('App\Order');
    }

    public function getPriceAttribute()
    {
        return $this->concert->ticket_price;
    }
}
