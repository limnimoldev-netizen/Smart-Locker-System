<?php

namespace Database\Seeders;

use App\Models\Locker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LockerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Locker::factory()->count(100)->create();
    }
}
