<?php

namespace Tests\Feature\CMS\Admin\CRUD\Artist;

use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class ArtistCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/artists';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_artist_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'artist_name' => 'New Artist'
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/artists/create');

        $flashMessage = session('success');
        $this->assertEquals('Artist created successfully!', $flashMessage);
    }

    /** @test */
    function the_slug_is_created_when_creating_a_new_artist()
    {
        $this->postJson(
            $this->endpoint, 
            [
                'artist_name' => 'A New Artist Name'
            ]
        );

        $expectedSlug = "a-new-artist-name";
        $artist = Artist::where('slug', $expectedSlug)->first();
        
        $this->assertEquals($expectedSlug,  $artist->slug);
    }
}
