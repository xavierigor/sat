<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orientando extends Model
{
    protected $table = 'orientandos';

    public function orientador() {
        return $this->belongsTo('App\Professor');
    }

    protected $fillable = [
        'orientador_id', 'aluno_id'
    ];

}
