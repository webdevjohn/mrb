<?php

namespace Tests\Feature\CMS\Admin\CRUD\Label;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class LabelCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/labels';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_label_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'label' => 'New Label'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/labels/create');

        $flashMessage = session('success');
        $this->assertEquals('Label created successfully!', $flashMessage);
    }

    /** @test */
    function the_slug_is_created_when_creating_a_new_label()
    {
        $this->postJson(
            $this->endpoint, 
            [
                'label' => 'A New Record Label'
            ]
        );

        $expectedSlug = "a-new-record-label";
        $label = Label::where('slug', $expectedSlug)->first();

        $this->assertEquals($expectedSlug,  $label->slug);
    }
}
