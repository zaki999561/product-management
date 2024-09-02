<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
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
            '商品画像' => $this->faker->imageUrl(),
          '商品名' => $this->faker->word(),
            '価格' => $this->faker->numberBetween(100, 10000),
            '在庫数' => $this->faker->numberBetween(1, 100),
            'メーカー名' => $this->faker->company(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
