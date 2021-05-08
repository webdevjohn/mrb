<?php

namespace Tests\Feature\CMS\Admin\Validation\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForGenreUpdateTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;
   
    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_genre_is_required()
    {
       $genre = Genre::factory()->createOne();

       $response = $this->patchJson(
            route('cms.basedata.genres.update', $genre), 
            [
                'genre' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre']
        );
    }

    /** @test  */
    public function a_genre_must_not_exceed_35_characters()
    {
        $tag = Genre::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.genres.update', $tag), 
            [
                'genre' => str::random(51)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre must not exceed 35 characters.',
            actualValidationMessage: $response['errors']['genre']
        );
    }
      
    /** @test  */
    public function when_a_genre_is_submitted_without_modification_the_genre_must_be_unique_rule_is_ignored()
    {
        $genre = Genre::factory()->createOne();
        
        $this->patchJson(
            route('cms.basedata.genres.update', $genre), 
            [
                'genre' => $genre->genre
            ]
        )
        ->assertStatus(302);    
    }

    /** @test  */
    public function if_the_genre_has_changed_the_updated_genre_submitted_must_be_unique()
    {
        $genre = Genre::factory()->createOne();
        $genre2 = Genre::factory()->createOne();
        
        // attempt to update $genre2 with a genre that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.basedata.genres.update', $genre2), 
            [
                'genre' => $genre->genre
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre');
    
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The genre submitted is already in the database.',
            actualValidationMessage: $response['errors']['genre']
        );
    }
}
