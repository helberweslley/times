<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $fillable = [
        'name', 'description', 'app_ip', 'app_user', 'app_pass', 'db_ip', 'db_user', 'db_pass'
    ];

    public function relationships(){
        return $this->hasMany(Relationship::class);
    }
}
