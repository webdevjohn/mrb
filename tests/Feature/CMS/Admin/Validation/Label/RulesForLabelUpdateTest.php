<?php

namespace Tests\Feature\CMS\Admin\Validation\Label;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthAdminUser;

class RulesForLabelUpdateTest extends TestCase
{
    use RefreshDatabase, AuthAdminUser, AssertValidationErrorMessages;

    /** @test  */
    public function a_label_is_required()
    {
        $label = Label::factory()->createOne();

        $response = $this->patchJson(
            route('cms.labels.update', $label), 
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
            route('cms.labels.update', $label), 
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
    public function the_label_must_be_unique_rule_is_ignored_when_updating_a_the_record_without_modifying_the_label_field()
    {
        $label = Label::factory()->createOne();
    
        $this->patchJson(
            route('cms.labels.update', $label), 
            [
                'label' => $label->label
            ]
        )
        ->assertStatus(302);
    }


    /** @test  */
    public function if_submitted_a_label_thumbnail_must_not_exceed_50_characters_in_length()
    {
        $label = Label::factory()->createOne();

        $response = $this->patchJson(
            route('cms.labels.update', $label), 
            [
                'label_thumbnail' => str::random(51)               
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_thumbnail');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label thumbnail must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['label_thumbnail']
        );
    }

    /** @test  */
    public function if_submitted_a_label_image_must_not_exceed_50_characters_in_length()
    {
        $label = Label::factory()->createOne();

        $response = $this->patchJson(
            route('cms.labels.update', $label), 
            [
                'label_image' => str::random(51)               
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_image');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label image must not exceed 50 characters.',
            actualValidationMessage: $response['errors']['label_image']
        );
    }
}
