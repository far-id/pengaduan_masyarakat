<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = ['user_id', 'kegiatan', 'gambar'];

    public function user(){
        return $this->belongsTo('App/User');
    }
}
