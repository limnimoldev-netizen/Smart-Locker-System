<?php

namespace Database\Factories;

use App\Enums\LockerStatus;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locker>
 */
class LockerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'locker_id' => 'LKR-' . strtoupper(Str::random(6)),
            'locker_code' => strtoupper(Str::random(8)),
            'location_id' => Location::inRandomOrder()->value('location_id'),
            'user_id' => User::inRandomOrder()->value('user_id'),
            'status' => $this->faker->randomElement(LockerStatus::cases()),    
        ];
    }
}
