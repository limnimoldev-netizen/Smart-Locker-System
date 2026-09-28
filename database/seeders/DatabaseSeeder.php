<?php

namespace Database\Seeders;

use Database\Seeders\LocationSeeder;
use Database\Seeders\LockerSeeder;
use Database\Seeders\MaintenanceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationSeeder::class,
            LockerSeeder::class,
            UserSeeder::class,
            MaintenanceSeeder::class,
        ]);
    }
}
