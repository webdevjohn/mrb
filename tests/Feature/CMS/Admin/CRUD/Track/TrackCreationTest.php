<?php

namespace Tests\Feature\CMS\Admin\CRUD\Track;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthUser;

class TrackCreationTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    protected $endpoint = '/cms/tracks';

    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test */
    function a_new_track_can_be_created_with_all_required_fields()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'artists' => Artist::factory(2)->create()->pluck('id')->toArray(),
                'title' => 'A new track title',
                'genre_id' => Genre::factory()->createOne()->id,
                'label_id' => Label::factory()->createOne()->id,
                'format_id' => Format::factory()->createOne()->id,
                'year_released' => 2021,
                'purchase_date' => "2021-12-20",
                'purchase_price' => 1.66,
            ]
        )->assertStatus(302);

        $response->assertRedirect('cms/tracks/create');

        $flashMessage = session('success');
        $this->assertEquals('Track created successfully!', $flashMessage);
    }

    /** @test */
    function a_new_track_can_be_created_with_all_fields()
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'artists' => Artist::factory(2)->create()->pluck('id')->toArray(),
                'title' => 'A new track title',
                'genre_id' => Genre::factory()->createOne()->id,
                'label_id' => Label::factory()->createOne()->id,
                'format_id' => Format::factory()->createOne()->id,
                'year_released' => 2021,
                'purchase_date' => "2021-12-20",
                'purchase_price' => 1.66,
                'bpm' => 150.0,
                'album_id' => Album::factory()->createOne()->id,
                'tags' => Tag::factory(4)->create()->pluck('id')->toArray(),
            ]
        )->assertStatus(302);

        $response->assertRedirect('cms/tracks/create');

        $flashMessage = session('success');
        $this->assertEquals('Track created successfully!', $flashMessage);
    }
}
