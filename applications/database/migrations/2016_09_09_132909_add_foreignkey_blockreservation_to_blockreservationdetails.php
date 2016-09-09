<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyBlockreservationToBlockreservationdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fra_blockreservationdetail', function($table){
          $table->integer('blockreservation_id')->unsigned();
          $table->foreign('blockreservation_id')->references('id')->on('fra_blockreservation');
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
