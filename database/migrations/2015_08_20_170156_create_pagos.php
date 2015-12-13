<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos',function(Blueprint $table){
            $table->increments('id');
            $table->date('fecpago');
            $table->integer('numfac');
            $table->float('valpago');
            $table->foreign('numfac')->references('numfac')->on('factura_cab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
