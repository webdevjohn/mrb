<?php

namespace Tests\Feature\CMS\Admin\Validation\Artist;

use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthAdminUser;

class RulesForArtistUpdateTest extends TestCase
{
    use RefreshDatabase, AuthAdminUser, AssertValidationErrorMessages;
   
    /** @test  */
    public function an_artist_name_is_required()
    {
       $artist = Artist::factory()->createOne();

       $response = $this->patchJson(
            route('cms.artists.update', $artist), 
            [
                'artist_name' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('artist_name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An artist name is required.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }

    /** @test  */
    public function an_artist_name_must_not_exceed_50_characters()
    {
        $artist = Artist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.artists.update', $artist), 
            [
                'artist_name' => str::random(51)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('artist_name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An artist name must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }
    
    /** @test  */
    public function when_an_artist_name_is_submitted_without_modification_the_artist_name_must_be_unique_rule_is_ignored()
    {
        $artist = Artist::factory()->createOne();
        
        $this->patchJson(
            route('cms.artists.update', $artist), 
            [
                'artist_name' => $artist->artist_name
            ]
        )
        ->assertStatus(302);    
    }

    /** @test  */
    public function if_the_artist_name_has_changed_the_updated_artist_name_submitted_must_be_unique()
    {
        $artist = Artist::factory()->createOne();
        $artist2 = Artist::factory()->createOne();
        
        // attempt to update $artist2 with an artist name that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.artists.update', $artist2), 
            [
                'artist_name' => $artist->artist_name
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('artist_name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The artist name submitted is already in the database.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }
}
