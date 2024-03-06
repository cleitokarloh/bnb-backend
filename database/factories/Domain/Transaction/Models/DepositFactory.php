<?php

namespace Database\Factories\Domain\Transaction\Models;

use App\Core\Support\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DepositFactory extends Factory
{
    protected $model = \Domain\Transaction\Models\Deposit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \Domain\User\Models\User::factory(),
            'description' => fake()->text(12),
            'amount' => fake()->numberBetween(50, 100),
            'image' => json_encode(new Image('deposit.jpg', 100)),
            'status' => \Domain\Transaction\Enums\DepositStatusEnum::PENDING,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
