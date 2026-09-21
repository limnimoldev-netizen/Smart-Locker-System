<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $totalSlots = fake()->numberBetween(10, 50);
        $cities = ['Phnom Penh', 'Siem Reap', 'Sihanoukville', 'Battambang', 'Kampot'];
        
        return [
            
        ];
    }
}
