<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Company;
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
            'img_path' => $this->faker->imageUrl(),
          'product_name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 10000),
            'stock' => $this->faker->numberBetween(1, 100),
            'company_id' => Company::inRandomOrder()->first()->id,
            'comment' => $this->faker->realtext(50),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
