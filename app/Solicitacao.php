<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    public function solicitado() {
        return $this->belongsTo('App\Professor');
    }
    
    public function solicitante() {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'tipo_solicitacao', 'solicitante_id', 'solicitado_id'
    ];

}
