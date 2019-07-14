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

    // Criei essa função para retornar os orientandos do professor
    public function getOrientandos() {
        $orientandos_id = Orientacao::where('orientador_id', Auth::user()->id)->pluck('aluno_id');

        $orientandos = User::whereIn('id', $orientandos_id)->get();

        return $orientandos;
    }

    public function coorientandos() {
        return $this->hasMany('App\Coorientacao');
    }
    
    public function tccs() {
        return $this->belongsToMany('App\Tcc');
    }
    
    public function solicitacoes() {
        return $this->hasMany('App\Solicitacao');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'data_nasc', 'telefone', 'image'
    ];

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
