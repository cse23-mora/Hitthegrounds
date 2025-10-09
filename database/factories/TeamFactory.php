<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_id' => Company::factory(),
            'team_name' => fake()->words(3, true) . ' Team',
            'captain_email' => fake()->safeEmail(),
            'captain_phone' => fake()->numerify('077#######'),
            'locked' => false,
            'approved' => false,
        ];
    }
}
