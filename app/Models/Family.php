<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{

    use SoftDeletes;



    public function types()
    {
        return $this->hasMany(Type::class, 'family_id', 'id');
    }
}
