<?php

namespace Tests\Feature\CMS\Admin\Validation\Artist;

use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AuthUser;
use Tests\Traits\AssertValidationErrorMessages;

class RulesForArtistCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    protected $endpoint = '/cms/basedata/artists';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function the_artist_name_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'artist_name' => null
        ])
        ->assertStatus(422);
        
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An Artist Name is required.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }

    /** @test  */
    public function the_artist_name_must_not_exceed_50_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'artist_name' => str::random(51)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An Artist Name must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }

    /** @test  */
    public function the_artist_name_must_be_unique()
    {
        $createdArtist = Artist::factory()->createOne(['artist_name' => 'New Artist']);

        $response = $this->postJson($this->endpoint, [
            'artist_name' => $createdArtist->artist_name
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Artist Name specified is already in the database.',
            actualValidationMessage: $response['errors']['artist_name']
        );
    }   
}
