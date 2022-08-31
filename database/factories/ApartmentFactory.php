<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'building_id' => rand(1, \App\Models\Building::count()),
            'floor' => rand(1, 20),
            'number' => rand(1, 4),
        ];
    }
}