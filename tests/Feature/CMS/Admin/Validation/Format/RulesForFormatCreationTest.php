<?php

namespace Tests\Feature\CMS\Admin\Validation\Format;

use App\Models\Format;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AuthUser;
use Tests\Traits\AssertValidationErrorMessages;

class RulesForFormatCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    protected $endpoint = '/cms/basedata/formats';
    
    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function the_format_field_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'format' => null
        ])
        ->assertStatus(422);
        
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Format is required.',
            actualValidationMessage: $response['errors']['format']
        );
    }

    /** @test  */
    public function the_format_field_must_not_exceed_25_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'format' => str::random(26)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Format must not exceed 25 characters.',
            actualValidationMessage: $response['errors']['format']
        );
    }

    /** @test  */
    public function a_format_must_be_unique()
    {
        $createdFormat = Format::factory()->createOne(['format' => 'New Format']);

        $response = $this->postJson($this->endpoint, [
            'format' => $createdFormat->format
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Format specified is already in the database.',
            actualValidationMessage: $response['errors']['format']
        );
    }   
}
