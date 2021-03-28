<?php

namespace Tests\Feature\CMS\Admin\Validation\Format;

use App\Models\Format;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthAdminUser;

class RulesForFormatUpdateTest extends TestCase
{
    use RefreshDatabase, AuthAdminUser, AssertValidationErrorMessages;
   
    /** @test  */
    public function a_format_is_required()
    {
       $format = Format::factory()->createOne();

       $response = $this->patchJson(
            route('cms.formats.update', $format), 
            [
                'format' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A format is required.',
            actualValidationMessage: $response['errors']['format']
        );
    }

    /** @test  */
    public function a_format_must_not_exceed_25_characters()
    {
        $format = Format::factory()->createOne();

        $response = $this->patchJson(
            route('cms.formats.update', $format), 
            [
                'format' => str::random(26)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('format');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A format must not exceed 25 characters.',
            actualValidationMessage: $response['errors']['format']
        );
    }
    
    /** @test  */
    public function when_a_format_is_submitted_without_modification_the_format_must_be_unique_rule_is_ignored()
    {
        $format = Format::factory()->createOne();
        
        $this->patchJson(
            route('cms.formats.update', $format), 
            [
                'format' => $format->format
            ]
        )
        ->assertStatus(302);    
    }

    /** @test  */
    public function if_the_format_has_changed_the_updated_format_submitted_must_be_unique()
    {
        $format = Format::factory()->createOne();
        $format2 = Format::factory()->createOne();
        
        // attempt to update $format2 with a format that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.formats.update', $format2), 
            [
                'format' => $format->format
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The format submitted is already in the database.',
            actualValidationMessage: $response['errors']['format']
        );
    }
}
