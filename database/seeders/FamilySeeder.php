<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('families')
            ->insert([
               ['name'=>'Оздоблювальні роботи'],
                ['name'=>'Інженерні системи і комунікації'],
                ['name'=>'Загальнобудівельні і монтажні роботи'],
            ]);
    }
}
