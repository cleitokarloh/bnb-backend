<?php

namespace Database\Factories\Domain\Transaction\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MovementFactory extends Factory
{
    protected $model = \Domain\Transaction\Models\Movement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => \Domain\Transaction\Enums\MovementTypeEnum::DEPOSIT,
            'user_id' => \Domain\User\Models\User::factory(),
            'description' => fake()->text(12),
            'amount' => fake()->numberBetween(50, 100),
            'date' => fake()->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
