<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RealDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::beginTransaction();

        try {
            DB::unprepared(file_get_contents('_db_dumps/users.sql'));
            $this->printStatus('users.sql');

            DB::unprepared(file_get_contents('_db_dumps/tags.sql'));
            $this->printStatus('tags.sql');
            
            DB::unprepared(file_get_contents('_db_dumps/artists.sql'));
            $this->printStatus('artists.sql');
            
            DB::unprepared(file_get_contents('_db_dumps/labels.sql'));
            $this->printStatus('labels.sql');

            DB::unprepared(file_get_contents('_db_dumps/genres.sql'));
            $this->printStatus('genres.sql');

            DB::unprepared(file_get_contents('_db_dumps/formats.sql'));
            $this->printStatus('formats.sql');

            DB::unprepared(file_get_contents('_db_dumps/albums.sql'));
            $this->printStatus('albums.sql');

            DB::unprepared(file_get_contents('_db_dumps/tracks.sql'));
            $this->printStatus('tracks.sql');

            DB::unprepared(file_get_contents('_db_dumps/tag_track.sql'));
            $this->printStatus('tag_track.sql');

            DB::unprepared(file_get_contents('_db_dumps/artist_track.sql'));
            $this->printStatus('artist_track.sql');

            DB::unprepared(file_get_contents('_db_dumps/roles.sql'));
            $this->printStatus('roles.sql');

            DB::unprepared(file_get_contents('_db_dumps/role_user.sql'));
            $this->printStatus('role_user.sql');

            DB::unprepared(file_get_contents('_db_dumps/playlists.sql'));
            $this->printStatus('playlists.sql');

            DB::unprepared(file_get_contents('_db_dumps/playlist_track.sql'));
            $this->printStatus('playlist_track.sql');

            DB::commit();

        } catch(\Exception $e) { 

            $this->command->getOutput()
                ->writeln("\n<comment>Something has gone wrong with one of .sql database dumps - logging error and rolling back database.</comment>\n");

            Log::error('Database seeding error', [
                'class' => 'RealDataSeeder',
                'method' => 'run',
                'error' => $e->getMessage()
            ]);

            DB::rollBack();
        }
    }

    /**
     *
     * @param string $name
     * @return void
     */
    protected function printStatus($name)
    {
        $this->command->getOutput()->writeln("<comment>Seeding:</comment> {$name}");
    }
}
