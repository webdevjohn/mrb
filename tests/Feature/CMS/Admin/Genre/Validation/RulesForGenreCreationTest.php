<?php

namespace Tests\Feature\CMS\Admin\Genre\Validation;

use App\Models\Genre;
use Tests\TestCase;
use Tests\Traits\AuthAdminUser;
use Tests\Traits\AssertValidationErrorMessages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RulesForGenreCreationTest extends TestCase
{
    use AuthAdminUser, RefreshDatabase, AssertValidationErrorMessages;

    protected $endpoint = '/cms/genres';

    /** @test  */
    public function the_genre_field_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'genre' => null
        ])
        ->assertStatus(422);
        
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Genre is required.',
            actualValidationMessage: $response['errors']['genre']
        );
    }

    /** @test  */
    public function the_genre_field_must_not_exceed_35_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'genre' => str::random(36)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Genre must not exceed 35 characters.',
            actualValidationMessage: $response['errors']['genre']
        );
    }

    /** @test  */
    public function a_genre_must_be_unique()
    {
        $createdGenre = Genre::factory()->createOne(['genre' => 'New Genre']);

        $response = $this->postJson($this->endpoint, [
            'genre' => $createdGenre->genre
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Genre specified is already in the database.',
            actualValidationMessage: $response['errors']['genre']
        );
    }   
}
