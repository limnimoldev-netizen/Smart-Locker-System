<?php

namespace Database\Factories;

use App\Enums\MaintenanceIssueType;
use App\Enums\MaintenanceStatus;
use App\Models\Location;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_id' => 'MTN-' . strtoupper(Str::random(6)),
            'locker_id' => Locker::inRandomOrder()->value('locker_id'),
            'location_id' => Location::inRandomOrder()->value('location_id'),
            'issue_type' => $issueType = $this->faker->randomElement(MaintenanceIssueType::cases()),
            'priority' => $issueType->defaultPriority(),
            'status' => $this->faker->randomElement(MaintenanceStatus::cases()),
            'reported_by' => User::inRandomOrder()->value('user_id'),
            'reported_at' => $this->faker->date(),
            'resolved_at' => $this->faker->date(),
        ];
    }
}
