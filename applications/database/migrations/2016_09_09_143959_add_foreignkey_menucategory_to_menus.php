<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyMenucategoryToMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fra_menus', function($table){
          $table->integer('menucategoty_id')->unsigned();
          $table->foreign('menucategoty_id')->references('id')->on('fra_menucategory');
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
