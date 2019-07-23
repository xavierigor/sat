<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';

    protected $fillable = [
        'tipo_usuario', 'notificado_id', 'mensagem' 
    ];

}
