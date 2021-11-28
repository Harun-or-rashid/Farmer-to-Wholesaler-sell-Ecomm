<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $title = $this->faker->title;
        $slug = Str::slug($title);
        return [
            'product_category_id' => rand(1,14),
            'title' => $title,
            'slug' => $slug,
            'quick_text' => $this->faker->realText(120),
            'product_details' => $this->faker->realText(220),
            'manufacturer' => $this->faker->company,
            'featured' => rand(0,1),
            'product_price' => 100
        ];
    }
}
