<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fra_branch', function(Blueprint $table){
          $table->increments('id');
          $table->string('name', 150);
          $table->string('address', 150);
          $table->text('description');
          $table->string('phone', 25);
          $table->string('hotline', 25);
          $table->string('maps', 250);
          $table->integer('user_id')->unsigned();
          $table->integer('flag_active')->unsigned();
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
