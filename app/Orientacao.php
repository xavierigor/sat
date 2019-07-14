<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orientacao extends Model
{
    protected $table = 'orientacoes';

    public function orientador() {
        return $this->belongsTo('App\Professor', 'orientador_id');
    }

    public function orientando() {
        return $this->hasOne('App\User', 'aluno_id');
    }

    protected $fillable = [
        'orientador_id', 'aluno_id'
    ];

}
