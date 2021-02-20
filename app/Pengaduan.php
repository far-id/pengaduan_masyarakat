<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = ['aduan', 'pengadu', 'tanggapan', 'penanggap', 'gambar', 'status'];

    public function user(){
        return $this->belongsTo('App/User');
    }
    public function petugas(){
        return $this->belongsToMany('App/Petugas');
    }
}

