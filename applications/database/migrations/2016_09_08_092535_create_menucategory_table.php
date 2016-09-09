<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenucategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fra_menucategory', function(Blueprint $table){
          $table->increments('id');
          $table->string('name', 50);
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
