<?php

namespace Tests\Feature\CMS\Admin\Validation\Label;

use App\Models\Label;
use Tests\TestCase;
use Tests\Traits\AuthAdminUser;
use Tests\Traits\AssertValidationErrorMessages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RulesForLabelCreationTest extends TestCase
{
    use AuthAdminUser, RefreshDatabase, AssertValidationErrorMessages;

    protected $endpoint = '/cms/labels';

    /** @test  */
    public function the_label_field_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'label' => null
        ])
        ->assertStatus(422);
        
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Label is required.',
            actualValidationMessage: $response['errors']['label']
        );
    }

    /** @test  */
    public function the_label_field_must_not_exceed_50_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'label' => str::random(51)
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A Label must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['label']
        );
    }

    /** @test  */
    public function a_label_must_be_unique()
    {
        $createdLabel = Label::factory()->createOne(['label' => 'New Label']);

        $response = $this->postJson($this->endpoint, [
            'label' => $createdLabel->label
        ])
        ->assertStatus(422);

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The Label specified is already in the database.',
            actualValidationMessage: $response['errors']['label']
        );
    }   
}
