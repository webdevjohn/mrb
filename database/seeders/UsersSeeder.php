<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::unprepared(file_get_contents('_db_dumps/users.sql'));
        } catch(\Exception $e) {
            echo "\n Something has gone wrong with the users.sql database dump! \n";
            
            User::factory(5)->create();
        }
    }
}
