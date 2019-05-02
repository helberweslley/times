<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $fillable = [
        'name',
    ];

    public function relationships(){
        return $this->hasMany(Relationship::class);
    }
}
