<?php

namespace Tests\Feature\CMS\Admin\Validation\Label;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForLabelUpdateTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function a_label_is_required()
    {
        $label = Label::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.labels.update', $label), 
            [
                'label' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label is required.',
            actualValidationMessage: $response['errors']['label']
        );
    }

    /** @test  */
    public function a_label_must_not_exceed_50_characters()
    {
        $label = Label::factory()->createOne();

        $response = $this->patchJson(
            route('cms.basedata.labels.update', $label), 
            [
                'label' => str::random(51)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('label');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['label']
        );
    }
    
    /** @test  */
    public function when_a_label_is_submited_without_modification_the_label_must_be_unique_rule_is_ignored()
    {
        $label = Label::factory()->createOne();
    
        $this->patchJson(
            route('cms.basedata.labels.update', $label), 
            [
                'label' => $label->label
            ]
        )
        ->assertStatus(302);
    }

    /** @test  */
    public function if_the_label_has_changed_the_updated_label_submitted_must_be_unique()
    {
        $label = Label::factory()->createOne();
        $label2 = Label::factory()->createOne();
        
        // attempt to update $label2 with a label that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.basedata.labels.update', $label2), 
            [
                'label' => $label->label
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The label submitted is already in the database.',
            actualValidationMessage: $response['errors']['label']
        );
    }
}
