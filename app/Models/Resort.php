<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //ex 

class Resort extends Model
{
    use SoftDeletes; // softDeletes lai pa visam neizdzestu lietas bet gan vienkarsi paslept tas no parastajiem lietotajiem  
}
