<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password', 'username', 'level',
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
        // 'email_verified_at' => 'datetime',
    ];

    public function kegiatan(){
        return $this->hasMany('App/Kegiatan');
    }
    public function masyarakat(){
        return$this->hasOne(Masyarakat::class);
    }
    public function pengaduan(){
        return $this->hasMany('App/Pengaduan');
    }
    public function petugas(){
        return$this->hasOne('App/Petugas');
    }
    
}
