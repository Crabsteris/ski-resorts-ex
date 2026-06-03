<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Resort;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
      
        User::factory()->create([
            'name' => 'Ance',
            'email' => 'ance@inbox.lv',
            'password' => 'ance1234',
            'role' =>'user',
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin1234',
            'role' =>'admin',
        ]);
        
        $this->call([
            CountrySeeder::class,
            ResortSeeder::class,
        ]);
    }
}
