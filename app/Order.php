<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function tickets()
    {
        $this->hasMany('App\Ticket');
    }

    public function total()
    {
        return array_reduce($this->total, function($carry, $product) {
            return $carry + $product->price;
        });

        $this->save();
    }
}
