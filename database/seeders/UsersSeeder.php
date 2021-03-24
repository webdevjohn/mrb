<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        User::factory(2)->create()->each(function ($user){
            $user->roles()->attach(
                Role::where('role', 'Registered User')->first()
            );
        });
    
        User::factory()->createOne()->roles()->attach(
            Role::where('role', 'Admin')->first()
        );
    }
}
