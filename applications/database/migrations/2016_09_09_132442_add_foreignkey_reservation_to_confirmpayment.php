<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyReservationToConfirmpayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fra_confirmpayment', function($table){
          $table->integer('reservation_id')->unsigned();
          $table->foreign('reservation_id')->references('id')->on('fra_reservation');
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
