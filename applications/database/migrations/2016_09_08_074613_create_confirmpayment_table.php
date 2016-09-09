<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fra_confirmpayment', function(Blueprint $table){
          $table->increments('id');
          $table->string('acc_no', 30);
          $table->string('acc_name', 50);
          $table->date('date_payment');
          $table->string('total_payment', 10);
          $table->string('notes', 150);
          $table->string('paymentimg', 150);
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
