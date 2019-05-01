<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $fillable = [
        'casa_id', 'visitante_id',
    ];

    public function casa(){
        return $this->belongsTo(Time::class);
    }
    public function visitante(){
        return $this->belongsTo(Time::class);
    }
}
