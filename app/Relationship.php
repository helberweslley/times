<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'source_id', 'target_id',
    ];

    public function source(){
        return $this->belongsTo(Sistema::class);
    }
    public function target(){
        return $this->belongsTo(Sistema::class);
    }
}
