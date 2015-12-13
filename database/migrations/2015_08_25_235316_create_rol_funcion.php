<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolFuncion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_funcion',function(Blueprint $table) {
            $table->integer('id_funcion')->unsigned()->nullable();
            $table->enum('role',['facturador','administrador','cartera','superadmin']);
            $table->primary(array('id_funcion', 'role'));
            $table->foreign('id_funcion')->references('id')->on('funciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_funcion'); 
    }
}
