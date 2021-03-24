<?php

namespace Tests\Feature\CMS\Admin\Validation\Artist;

use App\Models\Artist;
use Tests\TestCase;
use Tests\Traits\AuthAdminUser;
use Tests\Traits\AssertValidationErrorMessages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RulesForArtistCreationTest extends TestCase
{
    use AuthAdminUser, RefreshDatabase, AssertValidationErrorMessages;

    protected $endpoint = '/cms/artists';

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
