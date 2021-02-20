<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $fillable = ['user_id', 'kk', 'nik', 'nama', 'telpon', 'lahir'];
    protected $dates = ['lahir']; 

    public function user(){
        return$this->belongsTo(User::class);
    }
}
