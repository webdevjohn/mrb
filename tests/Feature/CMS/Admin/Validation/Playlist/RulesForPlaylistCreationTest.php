<?php

namespace Tests\Feature\CMS\Admin\Validation\Playlist;

use App\Models\playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForPlaylistCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    protected $endpoint = '/cms/playlists';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_name_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'name' => str::random(101)
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A name must not exceed 100 characters.',
            actualValidationMessage: $response['errors']['name']
        );  
    }

    /** @test  */
    public function a_name_must_be_unique()
    {
        $createdPlaylist = playlist::factory()->createOne();
   
        $response = $this->postJson($this->endpoint, [
            'name' => $createdPlaylist->name
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 0
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 9999
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted genre does not exist in the database.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }
}
