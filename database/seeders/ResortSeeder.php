<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resort;

class ResortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resort::create([
            'country_id' => 1,
            'name' => 'St. Anton',
            'description' => 'Admins (Mārtiņā) favorite skiing spot',
        ]);

        Resort::create([
            'country_id' => 2,
            'name' => 'Val Gardena',
            'description' => 'Located in the Dolomites',
        ]);

        Resort::create([
            'country_id' => 3,
            'name' => 'Zermatt',
            'description' => 'Famous Matterhorn views',
        ]);
    }
}
