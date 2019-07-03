<?php

namespace App\Observers;

use App\Concert;
use App\Ticket;

class ConcertObserver
{
    public function created(Concert $concert)
    {
        $tickets = [];

        for($i = 1; $i <= $concert->tickets_quantity; $i++) {
            $tickets[] = new Ticket([
                "order_id" => Null,
                "concert_id" => $concert->id
            ]);
        }

        return $concert->tickets()->saveMany($tickets);
    }
}
