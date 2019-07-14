<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    public function solicitado() {
        return $this->belongsTo('App\Professor', 'solicitado_id');
    }
    
    public function solicitante() {
        return $this->belongsTo('App\User', 'solicitante_id');
    }

    protected $fillable = [
        'tipo_solicitacao', 'solicitante_id', 'solicitado_id'
    ];

}
