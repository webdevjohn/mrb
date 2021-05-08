<?php

namespace Tests\Feature\CMS\Admin\CRUD\Format;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class FormatCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/formats';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_format_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'format' => 'new format'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/formats/create');

        $flashMessage = session('success');
        $this->assertEquals('Format created successfully!', $flashMessage);
    }
}
