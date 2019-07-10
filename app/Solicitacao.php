<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    public function professor() {
        return $this->belongsTo('App\Professor');
    }
    
    public function aluno() {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'tipo_solicitacao', 'solicitante_id', 'solicitado_id'
    ];

}
