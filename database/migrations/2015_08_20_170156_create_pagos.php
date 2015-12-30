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
            $table->integer('user')->unsigned();
            $table->timestamps();
            $table->foreign('numfac')->references('numfac')->on('factura_cab');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
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
