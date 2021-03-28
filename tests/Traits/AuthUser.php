<?php

namespace Tests\Traits;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

trait AuthUser {

    function createAuthUser(string $role = 'Admin'): void
    {
        User::factory()->createOne()->roles()->attach(
            Role::factory()->createOne(['role' => Str::title($role)])
        );

        $this->actingAs(
            User::first()
        );
    }
}
