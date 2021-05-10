<?php

namespace Tests\Feature\CMS\Admin\CRUD\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class RoleCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/roles';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_role_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'role' => 'new role'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/roles/create');

        $flashMessage = session('success');
        $this->assertEquals('Role created successfully!', $flashMessage);
    }
}
