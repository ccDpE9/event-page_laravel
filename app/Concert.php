<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Concert extends Model
{
    protected $fillable = [
        "title", "description", "date", "start_time", "end_time", "city", "venue", "venue_address", "ticket_price", "tickets_quantity"
    ];

    public function author()
    {
        return $this->belongsTo(\App\User::class);
    }

    // @TODO: Why do i need One to Many Concert-Order relationship?
    public function orders()
    {
        return $this->hasMany(\App\Order::class);
    }

    public function tickets()
    {
        return $this->hasMany(\App\Ticket::class);
    }

    public function getDateAttribute($value)
    {
        // --- Getter: remove hours part
        return Carbon::parse($value)->format('F j, Y');
    }

    public function getStartTimeAttribute($value)
    {
        // --- Getter: remove last two 0s
        return Carbon::parse($value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        // --- Getter: remove last two 0s
        return Carbon::parse($value)->format('H:i');
    }

    public function getTicketPriceInEurosAttribute($value)
    {
        // --- Get ticket_price attribute in specific currency
        // @TODO use switch to make the method more dynamic (DOLLARS, EUROS, ETC)
        // @TODO value is saved to the database in euros
        return number_format($this->ticket_price / 100, 2);
    }

    public function scopeUpcoming($query)
    {
        return $query
            ->where("date", ">", Carbon::now())
            ->orderBy("date", "asc");
    }

    public function ticketsLeft()
    {
        return $this->tickets()->available();
    }
}
