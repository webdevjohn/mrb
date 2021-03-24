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

            foreach($this->sqlFiles() as $sqlFile)
            {                
                DB::unprepared(file_get_contents("_db_dumps/$sqlFile"));
                $this->printStatus($sqlFile);
            }
        
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

    protected function sqlFiles(): array
    {
        return [
            'users.sql',
            'tags.sql',
            'artists.sql',
            'labels.sql',
            'genres.sql',
            'formats.sql',
            'albums.sql',
            'tracks.sql',
            'tag_track.sql',
            'artist_track.sql',
            'roles.sql',
            'role_user.sql',
            'playlists.sql',
            'playlist_track.sql'
        ];
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
