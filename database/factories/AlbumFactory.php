<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlbumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $name = $this->faker->name(25),
            'slug' => str::slug($name),
            'genre_id' => Genre::inRandomOrder()->first() ?? Genre::factory()->create(),
            'label_id' => Label::inRandomOrder()->first() ?? Label::factory()->create(),
            'format_id' => Format::inRandomOrder()->first() ?? Format::factory()->create(),
            'year_released' => rand(2000, 2021),
            'purchase_date' => Carbon::now()->subYears(rand(0, 7))->format('Y-m-d'),
            'purchase_price' => $this->faker->randomElement([4.99, 5.99, 6.99, 7.99, 8.99, 9.99, 10.99])  
        ];
    }
}
