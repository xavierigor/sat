<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // public function orientador() {
    //     return $this->hasOne('App\Professor');
    // }

    public function getOrientador() {
        $orientacao = Orientacao::where('aluno_id', $this->id)->first();

        if($orientacao) {
            return Professor::where('id', $orientacao->orientador_id)->first() ?? null;
        }

        return null;
    }

    public function tcc() {
        return $this->hasOne('App\Tcc');
    }

    public function solicitacao() {
        return $this->hasMany('App\Solicitacao');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'matricula', 'data_nasc', 'telefone', 'image', 'novas_notificacoes'
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
