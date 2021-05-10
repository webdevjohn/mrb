<?php

namespace Tests\Feature\CMS\Admin\CRUD\Playlist;

use App\Models\Genre;
use App\Models\Playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class PlaylistCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/playlists';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_playlist_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'A new playlist',
                'genre_id' => Genre::factory()->createOne()->id
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/playlists/create');

        $flashMessage = session('success');
        $this->assertEquals('Playlist created successfully!', $flashMessage);
    }

    /** @test */
    function the_slug_is_created_when_creating_a_new_playlist()
    {
        $this->postJson(
            $this->endpoint, 
            [
                'name' => 'A new playlist',
                'genre_id' => Genre::factory()->createOne()->id
            ]
        );

        $expectedSlug = "a-new-playlist";
        $playlist = Playlist::where('slug', $expectedSlug)->first();
        
        $this->assertEquals($expectedSlug,  $playlist->slug);
    }
}
