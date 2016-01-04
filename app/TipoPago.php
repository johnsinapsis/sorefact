<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_pago';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nomtipo','estado'];

    public $timestamps = false;
}
