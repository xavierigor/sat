<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defesa extends Model
{
    public function aluno() {
        return $this->belongsTo('App\User');
    }

    public function getOrientador() {
        return Professor::select('id', 'name')->where('id', $this->orientador_id)->first() ?? $this->orientador_name;
    }

    public function getSegundoAvaliador() {
        return Professor::select('id', 'name')->where('id', $this->avaliador_2_id)->first() ?? $this->avaliador_2_name;
    }

    public function getTerceiroAvaliador() {
        return Professor::select('id', 'name')->where('id', $this->avaliador_3_id)->first() ?? $this->avaliador_3_name;
    }
}
