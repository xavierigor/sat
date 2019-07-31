<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosAluno extends Model
{
    protected $table = 'documentos_alunos';

    public $timestamps = false;

    protected $dates = [
        'tc_updated_at',
        'ra_updated_at',
    ];

    public function tcc() {
        return $this->belongsTo('App\Tcc');
    }
}
