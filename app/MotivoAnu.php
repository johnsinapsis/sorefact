<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoAnu extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'motivo_anu';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nommotivo'];

    public $timestamps = false;
}
