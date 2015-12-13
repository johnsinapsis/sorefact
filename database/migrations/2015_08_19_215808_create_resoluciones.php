<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resoluciones',function(Blueprint $table){
            $table->increments('id');
            $table->string('num_resol',20);
            $table->date('fec_resol');
            $table->integer('ini_consec');
            $table->integer('fin_consec');
            $table->boolean('estado')->default(false);
            $table->string('nota_resol');
            $table->integer('act_consec');
            $table->integer('stock_consec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resoluciones');
    }
}
