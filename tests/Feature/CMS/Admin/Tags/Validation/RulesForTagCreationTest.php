<?php

namespace Tests\Feature\CMS\Admin\Tags\Validation;

use App\Models\Tag;
use Tests\TestCase;
use Tests\Traits\AuthAdminUser;
use Tests\Traits\AssertValidationErrorMessages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RulesForTagCreationTest extends TestCase
{
    use AuthAdminUser, RefreshDatabase, AssertValidationErrorMessages;

    protected $endpoint = '/cms/tags';

    /** @test  */
    public function the_tag_field_can_not_be_null()
    {
        $this->response = $this->postJson($this->endpoint, [
            'tag' => null
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Tag is required.'
        );
    }

    /** @test  */
    public function the_tag_field_must_not_exceed_50_characters()
    {
        $this->response = $this->postJson($this->endpoint, [
            'tag' => str::random(51)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Tag must not exceed 50 characters.'
        );  
    }

    /** @test  */
    public function a_tag_must_be_unique()
    {
        $createdTag = Tag::factory()->createOne(['tag' => 'tag1']);
   
        $this->response = $this->postJson($this->endpoint, [
            'tag' => $createdTag->tag
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Tag specified is already in the database.'
        );  
    }   
}
