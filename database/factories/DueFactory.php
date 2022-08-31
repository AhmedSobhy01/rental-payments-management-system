<?php

namespace Database\Factories;

use App\Models\Due;
use Illuminate\Database\Eloquent\Factories\Factory;

class DueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Due::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = rand(10, 4000);
        $discount = (rand(1, 9) < 7) ? rand(10, $amount) : 0;

        return [
            'amount' => $amount,
            'paid_amount' => rand(10, $amount - $discount),
            'discount' => $discount,
            'due_category_id' => rand(1, \App\Models\DueCategory::count()),
            'note' => (rand(1, 9) < 7) ? null : $this->faker->sentence(),
            'tenant_id' => rand(1, \App\Models\Tenant::count()),
        ];
    }
}