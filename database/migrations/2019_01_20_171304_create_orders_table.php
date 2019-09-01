<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->increments("id");
            $table->integer("ticket_id");
            //$table->string("confirmation_number");
            $table->string("charge_id");
            $table->integer("amount");
            $table->string("email");
            $table->string("name");
            $table->string("city");
            $table->string("street_address");
            $table->integer("postal_code");
            $table->integer("phone_number");
            //$table->string("card_last_four");
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
        Schema::dropIfExists("orders");
    }
}
