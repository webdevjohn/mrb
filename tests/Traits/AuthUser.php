<?php

namespace Tests\Traits;

use App\Models\Role;
use App\Models\User;

trait AuthUser {

    function createAuthUser(string $role = 'Admin'): void
    {
        User::factory()->createOne()->roles()->attach(
            Role::factory()->createOne(['role' => $role])
        );

        $this->actingAs(
            User::first()
        );
    }
}
