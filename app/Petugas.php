<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $fillable = ['user_id', 'level', 'nama', 'telpon'];

    public function users(){
        return $this->hasOne('App/User');
    }
    public function masyarakat(){
        return $this->belongsToMany('App/Masyarakat');
    }
}
