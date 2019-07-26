<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'datas';

    public $timestamps = false;

    protected $fillable = [
        'data_inicio', 'data_termino' 
    ];
}
