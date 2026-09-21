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
        $cities = ['Phnom Penh', 'Siem Reap', 'Sihanoukville', 'Battambang', 'Kampot', 'Kampong Cham'];
        $types = ['Mall', 'Plaza', 'Market', 'Center', 'Station', 'Hub'];
        $names = ['Aeon', 'Sorya', 'Angkor', 'Sovanna', 'Phsar Thmei', 'Olympia', 'Techo', 'Veng Sreng'];

        return [
            'name' => fake()->randomElement($names) . ' ' . fake()->randomElement($types),
            'city' => fake()->randomElement($cities),
            'address' => fake()->numberBetween(1, 200) . ' ' . fake()->randomElement(['Preah Monivong Blvd', 'Norodom Blvd', 'Sivatha Rd', 'National Road 4', 'Street 271']),
        ];
    }

    // Optional state helpers
    public function active(): static
    {
        return $this->state(fn () => ['status' => 'active']);
    }

    public function full(): static
    {
        return $this->state(fn (array $attrs) => [
            'available_slots' => 0,
            'total_slots'     => $attrs['total_slots'] ?? 20,
        ]);
    }

    public function maintenance(): static
    {
        return $this->state(fn () => ['status' => 'maintenance']);
    }
}
