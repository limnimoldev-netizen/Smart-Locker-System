<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Location;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Location::firstOrCreate(
            ['name' => 'Main Location'],
            [
                'address' => 'Main Street',
                'latitude' => '0',
                'longitude' => '0',
                'map_url' => 'https://www.google.com/maps',
                'status' => 'active',
            ]
        );
    }
}
