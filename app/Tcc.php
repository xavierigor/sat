<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    public function aluno() {
        return $this->belongsTo('App\User');
    }

    public function orientador() {
        return $this->hasOne('App\Professor');
        // return $this->belongsTo('App\Professor');
    }

    public function documentos() {
        return $this->hasOne('App\DocumentosAluno');
    }

    protected $fillable = [
        'titulo', 'area_de_pesquisa', 'disciplina',
    ];
    // protected $fillable = [
    //     'titulo', 'area_de_pesquisa', 'tcc', 'termo_de_compromissso', 'tc_status', 'rel_acompanhamento', 'ra_status'
    // ];
}
