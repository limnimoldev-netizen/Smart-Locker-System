<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'AEON Mall Station',
                'Airport Terminal 1',
                'Central Market Hub',
                'University Campus Lockers',
                'Train Station Kiosk',
                'Downtown Plaza Lockers',
            ]),
            'address' => $this->faker->streetAddress(),
            'available' => $this->faker->boolean(70),
        ];
    }
}
