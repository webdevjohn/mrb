<?php

namespace Tests\Feature\CMS\Admin\Validation\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForRoleUpdateTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;
   
    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_role_is_required()
    {
       $role = Role::factory()->createOne();

       $response = $this->patchJson(
            route('cms.roles.update', $role), 
            [
                'role' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('role');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A role is required.',
            actualValidationMessage: $response['errors']['role']
        );
    }

    /** @test  */
    public function a_role_must_not_exceed_50_characters()
    {
        $role = Role::factory()->createOne();

        $response = $this->patchJson(
            route('cms.roles.update', $role), 
            [
                'role' => str::random(51)
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('role');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A role must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['role']
        );
    }
    
    /** @test  */
    public function when_a_role_is_submitted_without_modification_the_role_must_be_unique_rule_is_ignored()
    {
        $role = Role::factory()->createOne();
        
        $this->patchJson(
            route('cms.roles.update', $role), 
            [
                'role' => $role->role
            ]
        )
        ->assertStatus(302);    
    }

    /** @test  */
    public function if_the_role_has_changed_the_updated_role_submitted_must_be_unique()
    {
        $role = Role::factory()->createOne();
        $role2 = Role::factory()->createOne();
        
        // attempt to update $role2 with a role that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.roles.update', $role2), 
            [
                'role' => $role->role
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('role');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The role submitted is already in the database.',
            actualValidationMessage: $response['errors']['role']
        );
    }
}
