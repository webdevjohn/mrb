<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistsTracksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::unprepared(file_get_contents('_db_dumps/artist_track.sql'));
        } catch(\Exception $e) {
            echo "\n Something has gone wrong with the artist_track.sql database dump! \n";          
        }
    }
}
