<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pagos';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecpago','numfac','valpago','user'];

}
