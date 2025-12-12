<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['nom' => 'Littoral'],
            ['nom' => 'Atlantique'],
            ['nom' => 'Ouémé'],
            ['nom' => 'Borgou'],
            ['nom' => 'Zou'],
        ];

        DB::table('regions')->insert($regions);
    }
}
