<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Professor extends Authenticatable
{
    protected $table = 'professores';

    public function orientandos() {
        // return $this->hasMany('App\User');
        return $this->hasMany('App\Orientando');
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
        'name', 'email', 'password',
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
