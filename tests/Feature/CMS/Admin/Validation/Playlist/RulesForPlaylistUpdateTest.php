<?php

namespace Tests\Feature\CMS\Admin\Validation\Playlist;

use App\Models\Genre;
use App\Models\Playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForPlaylistUpdateTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;
   
    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_name_is_required()
    {
       $playlist = Playlist::factory()->createOne();

       $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'name' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A name is required.',
            actualValidationMessage: $response['errors']['name']
        );
    }

    /** @test  */
    public function a_name_must_not_exceed_100_characters()
    {
        $playlist = Playlist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'name' => str::random(101)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A name must not exceed 100 characters.',
            actualValidationMessage: $response['errors']['name']
        );
    }
    
    /** @test  */
    public function when_a_name_is_submitted_without_modification_the_name_must_be_unique_rule_is_ignored()
    {
        $playlist = Playlist::factory()->createOne();
        $genre = Genre::factory()->createOne();
        
        $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'name' => $playlist->name,
                'genre_id' => $genre->id
            ]
        )
        ->assertStatus(302);    
    }

    /** @test  */
    public function if_the_playlist_has_changed_the_updated_playlist_submitted_must_be_unique()
    {
        $playlist = Playlist::factory()->createOne();
        $playlist2 = Playlist::factory()->createOne();
        
        // attempt to update the playlist name with a name that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist2), 
            [
                'name' => $playlist->name
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The name submitted is already in the database.',
            actualValidationMessage: $response['errors']['name']
        );
    }


    /** @test  */
    public function a_genre_is_required()
    {
        $playlist = Playlist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'genre_id' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_id_must_be_numeric()
    {
        $playlist = Playlist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'genre_id' => 'oiewjroijew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_id_must_be_greater_that_zero()
    {
        $playlist = Playlist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'genre_id' => 0
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_must_exist_in_the_database()
    {
        $playlist = Playlist::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.playlists.update', $playlist), 
            [
                'genre_id' => 9999
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted genre does not exist in the database.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }
}
