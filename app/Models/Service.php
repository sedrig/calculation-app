<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{

    use SoftDeletes;



    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }
}
