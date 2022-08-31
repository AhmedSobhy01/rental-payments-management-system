<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date(),
            'duration' => rand(1, 5),
            'rent_amount' => rand(1000, 5000),
            'apartment_id' => rand(1, \App\Models\Apartment::count()),
            'tenant_id' => rand(1, \App\Models\Tenant::count()),
        ];
    }
}