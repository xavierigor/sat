<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coorientacao extends Model
{
    protected $table = 'coorientacoes';

    public function coorientador() {
        return $this->belongsTo('App\Professor');
    }

    public function coorientando() {
        return $this->belongsTo('App\User', 'aluno_id');
    }

    protected $fillable = [
        'coorientador_id', 'aluno_id'
    ];
}
