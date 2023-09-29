<?php

namespace Database\Factories;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
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
            'name' => fake()->name(),
            'days' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'condominium_id' => $condominium->id,
        ];
    }
}
