<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleFuncion extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_funcion';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_funcion'];

    public $timestamps = false;
}
