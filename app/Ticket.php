<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = ["order_id"];

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

    public function orderTickets($tickets_quantity)
    {
        $order = new Order();
        $concert = Concert::findOrFail($concert_id);

        //foreach (range(1, $quantity) as $i) {
        foreach($tickets_quantity as $i) {
            $ticket = new Ticket;
            $order->tickets()->save($ticket);
        }

        // @TODO: This should be done inside Ticket observer
        $concert->tickets_left = $concert->tickets_left - $tickets_quantity;
        $concert->save();
    }

    public function scopeAvailable($query)
    {
        return $query
            ->where("order_id", Null)
            ->get()
            ->count();
    }
}
