<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->text(20),
            'product_sku' => Str::random(8),
            'product_category' => $this->faker->word(),
            'product_category_id' => rand(1, 10),
            'product_description' => $this->faker->realText(60),
            'product_image' => 'default.jpg',
            'user_id' => rand(1, 10),

        ];
    }
}
