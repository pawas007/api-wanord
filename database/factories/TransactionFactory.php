<?php

namespace Database\Factories;

use App\Enums\TransactionAction;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => rand(1, 20),
            'action' => TransactionAction::getAllActions()[array_rand(TransactionAction::getAllActions())],
            'user_id' => rand(1, 10)
        ];
    }
}
