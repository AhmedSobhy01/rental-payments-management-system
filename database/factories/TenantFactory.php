<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->name,
                'ar' => $this->faker->name,
            ],
            'email' => $this->faker->boolean ? $this->faker->unique()->safeEmail() : null,
            'phone' => $this->faker->unique()->phoneNumber(),
            'birthday' => $this->faker->date(),
            'nationality_id' => rand(1, \App\Models\Nationality::count()),
            'national_card_no' => $this->faker->numerify('##############'),
            'passport_no' => null,
            'married' => (rand(0, 9) < 7) ? true : false,
        ];
    }
}