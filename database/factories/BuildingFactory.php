<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => [
                'en' => $this->faker->address(),
                'ar' => $this->faker->address(),
            ],
            'number' => rand(1000, 999999),
        ];
    }
}
