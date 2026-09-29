<?php

namespace Database\Factories;

use App\Enums\LockerStatus;
use App\Models\Location;
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
            'locker_number' => strtoupper(Str::random(6)),
            'location_id' => Location::query()->inRandomOrder()->value('id'),
            'type' => $this->faker->randomElement(['standard', 'large']),
            'status' => $this->faker->randomElement(LockerStatus::cases())->value,
        ];
    }
}
