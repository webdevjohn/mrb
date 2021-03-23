<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::factory()->createMany([
            ['genre' => 'Drum and Bass', 'slug' => 'drum-and-bass'], 
            ['genre' => 'Hard House', 'slug' => 'hard-house'], 
            ['genre' => 'Hard Trance', 'slug' => 'hard-trance'], 
            ['genre' => 'House', 'slug' => 'house'], 
            ['genre' => 'NRG', 'slug' => 'nrg'], 
            ['genre' => 'Tech Trance', 'slug' => 'tech-trance'], 
            ['genre' => 'Techno', 'slug' => 'techno'],
            ['genre' => 'Trance', 'slug' => 'trance'],
            ['genre' => 'Breakbeat', 'slug' => 'breakbeat'],
            ['genre' => 'Tech House', 'slug' => 'tech-house'],
            ['genre' => 'Progressive Trance', 'slug' => 'progressive-trance']
        ]);
    }
}
