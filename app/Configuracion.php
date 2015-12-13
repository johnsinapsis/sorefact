<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'factura_conf';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nit_factura', 'nom_factura', 'tip_factura','dir_factura','tel_factura','mail_factura','web_factura','dias_venc','logotipo','marcagua','pie_pagina','nota_factura'];

    public $timestamps = false;
}
