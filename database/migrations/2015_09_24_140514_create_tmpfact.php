<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpfact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tmpfact',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idserv');
            $table->integer('cantserv');
            $table->decimal('valserv');
            $table->foreign('idserv')->references('COD_SER')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('tmpfact');
    }
}
