<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function is_admin()
    {
        return $this->is_admin === 1;
    }

    public function is_user()
    {
        return $this->is_admin === 0;
    }
}
