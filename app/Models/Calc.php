<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calc extends Model
{
    use HasFactory;
    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }
}
