<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    public function aluno() {
        return $this->belongsTo('App\User');
    }

    public function orientador() {
        return $this->belongsTo('App\Professor');
    }
}
