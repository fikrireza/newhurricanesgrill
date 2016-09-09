<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyRecipemenuToIngredientsAndMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fra_recipemenu', function($table){
          $table->integer('menu_id')->unsigned();
          $table->foreign('menu_id')->references('id')->on('fra_menus');
          $table->integer('ingredients_id')->unsigned();
          $table->foreign('ingredients_id')->references('id')->on('fra_ingredients');
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
