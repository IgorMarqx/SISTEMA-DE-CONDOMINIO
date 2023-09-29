<?php

namespace Database\Factories;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $condominium = Condominium::factory()->create();

        return [
            'identify' => 'APT ' . fake()->numberBetween(1, 999),
            'condominium_id' => $condominium->id,
        ];
    }
}
