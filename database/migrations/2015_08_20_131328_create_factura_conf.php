<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaConf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_conf',function(Blueprint $table){
            $table->increments('id');
            $table->string('nit_factura',20);
            $table->string('nom_factura',100);
            $table->string('tipo_factura',60);
            $table->string('dir_factura',150);
            $table->string('tel_factura',150);
            $table->string('mailfactura',70)->nullable();
            $table->string('web_factura',70)->nullable();
            $table->integer('dias_venc');
            $table->string('logotipo',100);
            $table->string('marcagua',100)->nullable();
            $table->text('pie_pagina')->nullable();
            $table->text('nota_factura')->nullable();
            $table->boolean('estado')->defaults('true');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('factura_conf');
    }
}
