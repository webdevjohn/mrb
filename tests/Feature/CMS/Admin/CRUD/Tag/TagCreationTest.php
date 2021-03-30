<?php

namespace Tests\Feature\CMS\Admin\CRUD\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class TagCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/tags';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_tag_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'tag' => 'new tag'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/tags/create');

        $flashMessage = session('success');
        $this->assertEquals('Tag created successfully!', $flashMessage);
    }
}
