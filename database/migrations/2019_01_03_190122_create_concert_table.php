<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcertTable extends Migration
{

    public function up()
    {
        Schema::create("concerts", function (Blueprint $table) {
            $table->increments("id");
            $table->string("title", 255);
            $table->string("description", 255); // This is basically "additional_information field", it gets visible only when user clicks on the concert        
            $table->date("date"); // date + start_time + end_time
            $table->string("slug");
            $table->time("start_time");
            $table->time("end_time");
            $table->string("city", 55);
            $table->string("venue", 55);
            $table->string("venue_address", 55);
            $table->float("ticket_price", 6, 2);
            $table->unsignedInteger("tickets_quantity");
            $table->softDeletes();
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
        Schema::dropIfExists("concerts");
    }
}
