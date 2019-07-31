<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosProfessor extends Model
{
    protected $table = 'documentos_professores';

    public $timestamps = false;

    protected $dates = [
        'updated_at',
    ];

    public function professor() {
        return $this->belongsTo('App\Professor');
    }
}
