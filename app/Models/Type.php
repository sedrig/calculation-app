<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{

    use SoftDeletes;



    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function last($service, $sobaka)
    {
        $mops = DB::table('calculations')
            ->where('calc_id', '=', $sobaka->id)
            ->where('service_id', '=', $service)
            ->first();


        if ($mops) {
            return $mops->price;
        } else {
            return 0;
        }
    }

    public function last_next($service, $sobaka)
    {
        $mops = DB::table('calculations')
            ->where('calc_id', '=', $sobaka->id)
            ->where('service_id', '=', $service)
            ->first();


        if ($mops) {


            return $mops->units;
        } else {
            return 0;
        }
    }
}
