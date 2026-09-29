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
        $names = [
            // Malls & Commercial
            'AEON Mall Phnom Penh',
            'AEON Mall Sen Sok',
            'Sorya Shopping Center',
            'TK Avenue Mall',
            'Eden Garden Mall',
            'Exchange Square',
            'Chip Mong 271 Mega Mall',
            'Midtown Community Mall',

            // Markets
            'Orussey Market',
            'Russian Market (Tuol Tom Poung)',
            'Central Market (Phsar Thmei)',
            'Boeung Keng Kang Market',
            'Kandal Market',

            // Universities & Schools
            'Royal University of Phnom Penh',
            'Institute of Technology of Cambodia',
            'Royal University of Law and Economics',
            'Paññāsāstra University',
            'Norton University',
            'Cambodia Academy of Digital Technology',

            // Transport Hubs
            'Phnom Penh International Airport',
            'Siem Reap International Airport',
            'Phnom Penh Railway Station',
            'Royal Railway Station Battambang',
            'Giant Ibis Bus Terminal',
            'VET Air Bus Terminal',

            // Public & Government
            'Ministry of Post and Telecommunications',
            'Phnom Penh City Hall',
            'National Library of Cambodia',
            'Olympic Stadium',
            'Morodok Techo National Stadium',

            // Hospitals
            'Calmette Hospital',
            'Royal Phnom Penh Hospital',
            'Khmer-Soviet Friendship Hospital',
            'Sunrise Japan Hospital',

            // Office & Coworking
            'Vattanac Capital Tower',
            'Exchange Square Office',
            'Emerald Hub',
            'Factory Phnom Penh',
            'The Point Coworking',

            // Other Provinces
            'Siem Reap Pub Street',
            'Battambang Central Market',
            'Sihanoukville Autonomous Port',
            'Kampot Riverside',
            'Kep Crab Market',
            'Koh Kong Bridge Terminal',
        ];
        
        return [
            'name' => $this->faker->randomElement($names),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(['mall', 'library', 'sports', 'station']),
            'status' => 'active',
        ];
    }
}
