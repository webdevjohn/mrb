<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaylistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Playlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->unique()->name(),
            'slug' => Str::slug($name),
            'genre_id' => Genre::inRandomOrder()->first() ?? Genre::factory()->create()
        ];
    }
}
