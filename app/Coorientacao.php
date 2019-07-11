<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coorientacao extends Model
{
    protected $table = 'coorientacoes';

    public function coorientador() {
        return $this->belongsTo('App\Professor');
    }

    protected $fillable = [
        'coorientador_id', 'aluno_id'
    ];
}
