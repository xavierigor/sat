<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    public function aluno() {
        return $this->belongsTo('App\User');
    }

    public function orientador() {
        return $this->hasOne('App\Professor');
        // return $this->belongsTo('App\Professor');
    }

    protected $fillable = [
        'titulo', 'area_de_pesquisa', 'tcc'
    ];
}
