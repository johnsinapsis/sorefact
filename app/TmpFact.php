<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpFact extends Model
{
    
/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tmpfact';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idserv', 'cantserv','valserv'];
    public $timestamps = false;
}
