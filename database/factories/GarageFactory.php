<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Garage>
 */
class GarageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $apartment = Apartment::factory()->create();

        return [
            'identify' => 'GARAGE '.fake()->numberBetween(1, 999),
            'apartment_id' => $apartment->id,
        ];
    }
}
