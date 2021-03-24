<?php

namespace Tests\Traits;

use App\Models\Role;
use App\Models\User;

trait AuthAdminUser {

    function setUp(): void
    {
        parent::setup();

        User::factory()->createOne()->roles()->attach(
            Role::factory()->createOne(['role' => 'Admin'])
        );

        $this->actingAs(
            User::first()
        );
    }
}
