<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //eksamens
    protected $fillable = [
        'name'
    ];

    public function resorts()
    {
        return $this->hasMany(Resort::class);
    } 
}
