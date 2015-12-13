<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaCab extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'factura_cab';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numfac', 'fecfac', 'cod_ent','estfac','usufac','fecrad','motianu','obseanu'];
}
