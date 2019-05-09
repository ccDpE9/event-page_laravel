<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcertTable extends Migration
{

    public function up()
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('description');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('city', 55);
            $table->string('venue', 55);
            $table->string('venue_address', 55);
            $table->string('additional_information', 255);
            $table->decimal('ticket_price', 6, 2);
            $table->integer('tickets_quantity');
            $table->integer('tickets_left');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concerts');
    }
}
