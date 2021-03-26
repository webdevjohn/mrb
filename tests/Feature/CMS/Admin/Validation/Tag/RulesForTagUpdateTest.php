<?php

namespace Tests\Feature\CMS\Admin\Validation\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthAdminUser;

class RulesForTagUpdateTest extends TestCase
{
    use RefreshDatabase, AuthAdminUser, AssertValidationErrorMessages;
   
    /** @test  */
    public function a_tag_is_required()
    {
       $tag = Tag::factory()->createOne();

       $response = $this->patchJson(
            route('cms.tags.update', $tag), 
            [
                'tag' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('tag');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A tag is required.',
            actualValidationMessage: $response['errors']['tag']
        );
    }

    /** @test  */
    public function a_tag_must_not_exceed_50_characters()
    {
        $tag = Tag::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tags.update', $tag), 
            [
                'tag' => str::random(51)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('tag');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A tag must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['tag']
        );
    }
 
    /** @test  */
    public function the_tag_must_be_unique_rule_is_ignored_when_updating_a_the_record_without_modifying_the_tag_field()
    {
        $tag = Tag::factory()->createOne();
        
        $this->patchJson(
            route('cms.tags.update', $tag), 
            [
                'tag' => $tag->tag
            ]
        )
        ->assertStatus(302);    
    }
}
