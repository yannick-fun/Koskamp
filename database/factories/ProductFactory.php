<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'sku' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'price' => $this->faker->numberBetween(100, 10000),
            'description' => $this->faker->paragraph,
            'image' => 'https://fakeimg.pl/350x200',
        ];
    }
}
