<?php

namespace Database\Factories;

use App\Models\Wager;
use Illuminate\Database\Eloquent\Factories\Factory;

class WagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wager::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_wager_value' => $this->faker->numberBetween(1, 100),
            'odds' => $this->faker->numberBetween(1, 100),
            'selling_percentage' => $this->faker->numberBetween(1, 100),
            'selling_price' => $this->faker->randomDigitNotNull
        ];
    }
}
