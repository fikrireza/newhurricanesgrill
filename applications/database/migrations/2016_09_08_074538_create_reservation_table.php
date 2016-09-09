<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fra_reservation', function(Blueprint $table){
          $table->increments('id');
          $table->string('name', 50);
          $table->string('handphone', 20);
          $table->integer('size')->unsigned();;
          $table->string('email', 50);
          $table->date('reserve_date');
          $table->time('reserve_time');
          $table->text('specialreq');
          $table->integer('status')->unsigned();;
          $table->string('booking_code', 6);
          $table->integer('user_id')->nullable();
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
        //
    }
}
