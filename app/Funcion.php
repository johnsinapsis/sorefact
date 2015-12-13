<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funciones';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nomfuncion'];

    public $timestamps = false;
}