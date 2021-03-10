<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(UsersSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(ArtistsSeeder::class);
        $this->call(LabelsSeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(FormatsSeeder::class);
        $this->call(AlbumsSeeder::class);
        $this->call(TracksSeeder::class);
        $this->call(TagsTracksSeeder::class);
        $this->call(ArtistsTracksSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RolesUsersSeeder::class);
        $this->call(PlaylistsSeeder::class);
        $this->call(PlaylistsTracksSeeder::class);
    }
}
