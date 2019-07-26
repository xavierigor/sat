<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    public function autor() {
        return $this->belongsTo('App\Coordenador', 'coordenador_id');
    }
}
