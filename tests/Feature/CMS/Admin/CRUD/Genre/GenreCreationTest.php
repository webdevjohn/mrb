<?php

namespace Tests\Feature\CMS\Admin\CRUD\Genre;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class GenreCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/genres';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_genre_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'genre' => 'new genre'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/genres/create');

        $flashMessage = session('success');
        $this->assertEquals('Genre created successfully!', $flashMessage);
    }

    /** @test */
    function the_slug_is_created_when_creating_a_new_genre()
    {
        $this->postJson(
            $this->endpoint, 
            [
                'genre' => 'A New Genre'
            ]
        );

        $expectedSlug = "a-new-genre";
        $genre = Genre::where('slug', $expectedSlug)->first();
        
        $this->assertEquals($expectedSlug,  $genre->slug);
    }
}
