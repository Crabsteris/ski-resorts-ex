<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //ex 
use App\Models\Country;

class Resort extends Model
{
    //ex
    use SoftDeletes; // softDeletes lai pa visam neizdzestu lietas bet gan vienkarsi paslept tas no parastajiem lietotajiem  

    protected $fillable = [
        'country_id',
        'name',
        'description',
        'image',
        'latitude',
        'longitude',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}

