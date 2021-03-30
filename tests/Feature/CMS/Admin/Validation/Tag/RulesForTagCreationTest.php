<?php

namespace Tests\Feature\CMS\Admin\Validation\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForTagCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    protected $endpoint = '/cms/tags';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_tag_is_required()
    {
        $response = $this->postJson($this->endpoint, [
            'tag' => null
        ])
        ->assertStatus(422);


        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Tag is required.',
            actualValidationMessage: $response['errors']['tag']
        );
    }

    /** @test  */
    public function a_tag_must_not_exceed_50_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'tag' => str::random(51)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Tag must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['tag']
        );  
    }

    /** @test  */
    public function a_tag_must_be_unique()
    {
        $createdTag = Tag::factory()->createOne(['tag' => 'tag1']);
   
        $response = $this->postJson($this->endpoint, [
            'tag' => $createdTag->tag
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Tag specified is already in the database.',
            actualValidationMessage: $response['errors']['tag']
        );  
    }   
}
