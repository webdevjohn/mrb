<?php

namespace Tests\Feature\CMS\Admin\Validation\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForRoleCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    protected $endpoint = '/cms/basedata/roles';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_role_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'role' => null
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A role is required.',
            actualValidationMessage: $response['errors']['role']
        );
    }

    /** @test  */
    public function a_role_must_not_exceed_50_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'role' => str::random(51)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A role must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['role']
        );  
    }

    /** @test  */
    public function a_role_must_be_unique()
    {
        $createdRole = Role::factory()->createOne();
   
        $response = $this->postJson($this->endpoint, [
            'role' => $createdRole->role
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The role submitted is already in the database.',
            actualValidationMessage: $response['errors']['role']
        );  
    }   
}
