<?php

namespace Database\Factories;

use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Track::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(25),
            'genre_id' => Genre::inRandomOrder()->first() ?? Genre::factory()->create(),
            'label_id' => Label::inRandomOrder()->first() ?? Label::factory()->create(),
            'format_id' => Format::inRandomOrder()->first() ?? Format::factory()->create(),
            'year_released' => rand(1990, 2021),
            'purchase_date' => Carbon::now()->subYears(rand(0, 7))->format('Y-m-d'),
            'purchase_price' => $this->faker->randomElement([1.69, 1.99]) 
        ];
    }
}
