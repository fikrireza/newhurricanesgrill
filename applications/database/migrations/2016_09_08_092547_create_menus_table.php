<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fra_menus', function(Blueprint $table){
          $table->increments('id');
          $table->string('name', 100);
          $table->text('directions');
          $table->text('notes');
          $table->string('image', 100);
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
