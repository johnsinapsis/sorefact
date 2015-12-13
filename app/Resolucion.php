<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'resoluciones';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['num_resol', 'fec_resol', 'ini_consec','fin_consec','nota_resol','stock_consec'];

    public $timestamps = false;
}
