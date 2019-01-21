<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function tickets()
    {
        $this->hasMany('App\Ticket');
    }

    public function concert()
    {
        $this->belongsTo('App\Concert');
    }

    public function ticketsQuantity()
    {
        // @TODO: ->tickets() vs ->tickets
        return $this->tickets()->count;
    }
}
