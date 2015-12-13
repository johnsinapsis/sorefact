<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDet extends Model
{
    
/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'factura_det';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numfac', 'idserv', 'cantserv','valserv'];
    public $timestamps = false;
}
