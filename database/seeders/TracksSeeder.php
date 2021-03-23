<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Tag;
use App\Models\Track;
use Illuminate\Database\Seeder;

class TracksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Track::factory(25)->create()->each(function ($track) {
        
            $track->artists()->attach(
                Artist::inRandomOrder()->first() ?? Artist::factory()->create()
            );

            $track->tags()->attach(
                Tag::inRandomOrder()->limit(5)->get() ?? Tag::factory()->create()
            );
        });   
    }
}
