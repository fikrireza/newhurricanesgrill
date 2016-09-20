<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTimesIntoBlockreservationsdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('fra_blockreservationdetail', function ($table) {
        $table->time('times1')->after('times')->nullable();
        $table->time('times2')->after('times1')->nullable();
        $table->time('times3')->after('times2')->nullable();
        $table->time('times4')->after('times3')->nullable();
        $table->time('times5')->after('times4')->nullable();
        $table->time('times6')->after('times5')->nullable();
        $table->time('times7')->after('times6')->nullable();
        $table->time('times8')->after('times7')->nullable();
        $table->time('times9')->after('times8')->nullable();
        $table->time('times10')->after('times9')->nullable();
        $table->time('times11')->after('times10')->nullable();
        $table->integer('flag_active')->default(1);
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
