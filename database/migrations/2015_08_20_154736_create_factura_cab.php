<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaCab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_cab',function(Blueprint $table){
            $table->integer('numfac');
            $table->primary('numfac');
            $table->date('fecfac');
            $table->string('cod_ent',20);
            $table->char('estfac',1);
            $table->integer('usufac')->unsigned();
            $table->date('fecrad')->nullable();
            $table->integer('usurad')->unsigned()->nullable();
            $table->date('fecanu')->nullable();
            $table->integer('usuanu')->unsigned()->nullable();
            $table->integer('motianu')->unsigned()->nullable();
            $table->string('obseanu')->nullable();
            $table->timestamps();
            $table->foreign('usufac')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usurad')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usuanu')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('motianu')->references('id')->on('motivo_anu')->onDelete('cascade');
            
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('factura_cab');
    }
}
