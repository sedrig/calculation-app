<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')
            ->insert([
                ['name'=>'Плиточні роботи','family_id'=>1],
                ['name'=>'Малярні роботи','family_id'=>1],
                ['name'=>'Штукатурні роботи','family_id'=>1],
                ['name'=>'Електромонтажні роботи','family_id'=>2],
                ['name'=>'Сантехнічні роботи','family_id'=>2],
                ['name'=>'Системи опалення','family_id'=>2],
                ['name'=>'Фасадні роботи','family_id'=>3],
                ['name'=>'Кладочні роботи','family_id'=>3],
                ['name'=>'Фундамент','family_id'=>3],
            ]);
    }
}
