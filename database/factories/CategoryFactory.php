<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Category::class;

    
    public function definition()
    {
        $category_name = $this->faker->unique()->words($nd=2,$asText=true);
        $slug = Str::slug($category_name);
        return [
            'name' => $category_name,
            'slug' => $slug
        ];
    }
}
