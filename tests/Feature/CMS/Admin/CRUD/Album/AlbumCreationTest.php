<?php

namespace Tests\Feature\CMS\Admin\CRUD\Album;

use App\Models\Album;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class AlbumCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/basedata/albums';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_album_can_be_created()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'title' => 'A new album',
                'genre_id' => Genre::factory()->createOne()->id,
                'label_id' => Label::factory()->createOne()->id,
                'format_id' => Format::factory()->createOne()->id,
                'year_released' => 2021,
                'purchase_date' => "2021-12-20",
                'purchase_price' => 12.49,
                'use_track_artwork' => true
            ]
        )
        ->assertStatus(302);

        $response->assertRedirect('cms/basedata/albums/create');

        $flashMessage = session('success');
        $this->assertEquals('Album created successfully!', $flashMessage);
    }

    /** @test */
    function the_slug_is_created_when_creating_a_new_album()
    {
        $this->postJson(
            $this->endpoint, 
            [
                'title' => 'A new album',
                'genre_id' => Genre::factory()->createOne()->id,
                'label_id' => Label::factory()->createOne()->id,
                'format_id' => Format::factory()->createOne()->id,
                'year_released' => 2021,
                'purchase_date' => '2021-12-20',
                'purchase_price' => 12.49,
                'use_track_artwork' => true
            ]
        );

        $expectedSlug = "a-new-album";
        $album = Album::where('slug', $expectedSlug)->first();
        
        $this->assertEquals($expectedSlug,  $album->slug);
    }
}
