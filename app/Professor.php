<?php

namespace App;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Professor extends Authenticatable
{
    protected $table = 'professores';

    public function orientandos() {
        // return $this->hasMany('App\User');
        return $this->hasMany('App\Orientacao');
    }

    public function coorientandos() {
        return $this->hasMany('App\Coorientacao');
    }
    
    public function tccs() {
        return $this->belongsToMany('App\Tcc');
    }

    public function documentos() {
        return $this->hasOne('App\DocumentosProfessor');
    }
    
    public function solicitacoes() {
        return $this->hasMany('App\Solicitacao', 'solicitado_id');
    }

    public function getOrientandos() {
        
        // $orientandos_id = Orientacao::where('orientador_id', Auth::user()->id)->pluck('aluno_id');
        // $orientandos = User::whereIn('id', $orientandos_id)->get();

        // Buscando se há algum orientando e seu dados
        $orientacoes = Orientacao::select('id', 'aluno_id')
                                ->where("orientador_id", Auth::guard('professor')->user()->id)
                                ->with(['orientando:id,name,image'])
                                ->get();
        // dd($orientacoes);
        return $orientacoes;
    }

    public function getCoorientandos() {
        
        // Buscando se há algum orientando e seu dados
        $coorientacoes = Coorientacao::select('id', 'aluno_id')
                                ->where("coorientador_id", Auth::guard('professor')->user()->id)
                                ->with(['coorientando:id,name,image'])
                                ->get();
        return $coorientacoes;
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'data_nasc', 'telefone', 'image', 'num_orientandos', 'num_coorientandos', 'novas_notificacoes'
    ];
    // protected $fillable = [
    //     'name', 'email', 'password', 'data_nasc', 'telefone', 'image', 'termo_de_responsabilidade', 'tr_status', 'num_orientandos', 'num_coorientandos', 'novas_notificacoes'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
