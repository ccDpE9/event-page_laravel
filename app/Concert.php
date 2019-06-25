<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Concert extends Model
{

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

    public function scopeUpcoming($query, $take=3)
    {
        return $query
            ->where("date", ">", Carbon::now())
            ->orderBy("date", "asc");
    }

}
