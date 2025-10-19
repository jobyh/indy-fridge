<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beer>
 */
class BeerFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $color = $this->faker->colorName();

        return [
            'url' => 'https://example.com/'.Str::slug($color).'/',
            'name' => "$color Beer",
            'brewery' => "$color Brewery",
            'style' => 'IPA',
            'description' => 'A test beer description',
            'hops' => ['Citra', 'Mosaic'],
            'tags' => ['hoppy', 'citrus'],
            'abv' => 5.5,
            'price' => 550,
            'stock' => 10,
            'size' => '440ml',
            'published_at' => now()->subDays(2),
            'modified_at' => now()->subDay(),
        ];
    }
}
