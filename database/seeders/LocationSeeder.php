<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::factory()->count(20)->create();

        // Example specific entries
        Location::factory()->create([
            'locker_id'       => 'LCK-0001',
            'location_name'   => 'Central Mall',
            'address'         => '123 Main Street',
            'city'            => 'Jakarta',
            'latitude'        => -6.2088,
            'longitude'       => 106.8456,
            'status'          => 'active',
            'total_slots'     => 24,
            'available_slots' => 10,
        ]);

        Location::factory()->full()->create([
            'locker_id'     => 'LCK-0002',
            'location_name' => 'Grand Station',
            'city'          => 'Jakarta',
        ]);

        Location::factory()->maintenance()->create([
            'locker_id'     => 'LCK-0003',
            'location_name' => 'City Library',
            'city'          => 'Bandung',
        ]);
    }
}
