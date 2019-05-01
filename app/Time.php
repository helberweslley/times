<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'name',
    ];

    public function jogos(){
        return $this->hasMany(Jogo::class);
    }
}
