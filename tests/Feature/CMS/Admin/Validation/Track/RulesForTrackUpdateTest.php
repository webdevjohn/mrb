<?php

namespace Tests\Feature\CMS\Admin\Validation\Track;

use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthUser;

class RulesForTrackUpdateTest extends TestCase
{
    use RefreshDatabase, AuthUser, AssertValidationErrorMessages;
   
    function setUp(): void
    {
        parent::setup();

        $this->createAuthUser();
    }

    /** @test  */
    public function an_artist_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'artists' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('artists');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An artist is required.',
            actualValidationMessage: $response['errors']['artists']
        );
    }

    /** @test  */
    public function the_submitted_artists_must_be_sent_as_an_array()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(            
            route('cms.tracks.update', $track), 
            [
                'artists' => 'ewrewr'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('artists');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An artist is required.',
            actualValidationMessage: $response['errors']['artists']
        );
    }

    /** @test  */
    public function the_submitted_artists_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(            
            route('cms.tracks.update', $track), 
            [
                'artists' => [99999, 99998]
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('artists');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted artist(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['artists']
        );
    }


    /** @test  */
    public function a_title_is_required()
    {
       $track = Track::factory()->createOne();

       $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'title' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('title');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A title is required.',
            actualValidationMessage: $response['errors']['title']
        );
    }

    /** @test  */
    public function a_title_must_not_exceed_125_characters()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'title' => str::random(126)
            ]
        )     
        ->assertStatus(422)
        ->assertJsonValidationErrors('title');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A title must not exceed 125 characters.',
            actualValidationMessage: $response['errors']['title']
        );
    }
    
    /** @test  */
    public function a_genre_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'genre_id' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_id_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'genre_id' => 'oiewjroijew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_id_must_be_greater_that_zero()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'genre_id' => 0
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A genre is required.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }

    /** @test  */
    public function the_submitted_genre_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'genre_id' => 9999
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('genre_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted genre does not exist in the database.',
            actualValidationMessage: $response['errors']['genre_id']
        );
    }


    /** @test  */
    public function a_label_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'label_id' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label is required.',
            actualValidationMessage: $response['errors']['label_id']
        );
    }

    /** @test  */
    public function the_submitted_label_id_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'label_id' => 'oiewjroijew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label is required.',
            actualValidationMessage: $response['errors']['label_id']
        );
    }

    /** @test  */
    public function the_submitted_label_id_must_be_greater_that_zero()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'label_id' => 0
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A label is required.',
            actualValidationMessage: $response['errors']['label_id']
        );
    }

    /** @test  */
    public function the_submitted_label_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'label_id' => 9999,
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('label_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted label does not exist in the database.',
            actualValidationMessage: $response['errors']['label_id']
        );
    }


    /** @test  */
    public function a_format_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'format_id' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A format is required.',
            actualValidationMessage: $response['errors']['format_id']
        );
    }

    /** @test  */
    public function the_submitted_format_id_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'format_id' => 'oiewjroijew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A format is required.',
            actualValidationMessage: $response['errors']['format_id']
        );
    }

    /** @test  */
    public function the_submitted_format_id_must_be_greater_that_zero()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'format_id' => 0
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A format is required.',
            actualValidationMessage: $response['errors']['format_id']
        );
    }

    /** @test  */
    public function the_submitted_format_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'format_id' => 9999,
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('format_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted format does not exist in the database.',
            actualValidationMessage: $response['errors']['format_id']
        );
    }


    /** @test  */
    public function a_year_of_released_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track), 
            [
                'year_released' => null,
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The year of release is required.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_of_release_must_be_exactly_4_digits_in_length()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [ 
                'year_released' => 19801
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted year of release must be exactly 4 digits in length.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_of_release_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [ 
                'year_released' => 'ejwrewew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The year of release must be numeric.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_of_release_must_be_after_1979()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'year_released' => 1979
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 
            
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted year of release must be greater than 1979.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_released_can_not_be_in_the_future()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'year_released' => (date('Y')+1)
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted year of release can not be in the future.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }


    /** @test  */
    public function a_purchase_date_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_date' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_date');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A purchase date is required.',
            actualValidationMessage: $response['errors']['purchase_date']
        );
    }

    /** @test  */
    public function a_purchase_date_must_be_a_valid_date()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_date' => '2019-21-21'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_date');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The purchase date must be a valid date.',
            actualValidationMessage: $response['errors']['purchase_date']
        );
    }

    /** @test  */
    public function the_purchase_date_must_be_formatted_correctly()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_date' => '01-01-2020'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_date');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The purchase date must be in the yyyy-mm-dd format (e.g. 2020-12-18).',
            actualValidationMessage: $response['errors']['purchase_date']
        );
    }


    /** @test  */
    public function a_purchase_price_is_required()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_price' => null
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_price');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A purchase price is required.',
            actualValidationMessage: $response['errors']['purchase_price']
        );
    }
  
    /** @test  */
    public function the_purchase_price_field_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_price' => 'qoiwjreoi'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_price');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A purchase price must be numeric.',
            actualValidationMessage: $response['errors']['purchase_price']
        );
    }

    /** @test  */
    public function a_purchase_price_must_be_at_least_zero()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_price' => -1
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_price');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A purchase price must be between 0 - 50.',
            actualValidationMessage: $response['errors']['purchase_price']
        );
    }


    /** @test  */
    public function a_purchase_price_can_not_be_greater_than_50()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'purchase_price' => 51
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('purchase_price');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A purchase price must be between 0 - 50.',
            actualValidationMessage: $response['errors']['purchase_price']
        );
    }


    /*
    |---------------------------------------------------------------------------------------
    | The following tests are for the fields that can be nullable when creating a new Track.
    |---------------------------------------------------------------------------------------   
    */

    /** @test  */
    public function if_submitted_the_bpm_field_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
            'bpm' => 'qoiwjreoi'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('bpm');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The BPM field must be numeric.',
            actualValidationMessage: $response['errors']['bpm']
        );
    }

    /** @test  */
    public function if_submitted_the_bpm_field_must_be_at_least_100()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'bpm' => 99
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('bpm');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The BPM field must be between 100.0 - 200.0.',
            actualValidationMessage: $response['errors']['bpm']
        );
    }

    /** @test  */
    public function if_submitted_the_bpm_field_must_not_be_greater_than_200()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'bpm' => 200.5
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('bpm');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The BPM field must be between 100.0 - 200.0.',
            actualValidationMessage: $response['errors']['bpm']
        );
    }


    /** @test  */
    public function if_submitted_the_album_id_field_must_be_numeric()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'album_id' => 'qoiwjreoi'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('album_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted album must be valid.',
            actualValidationMessage: $response['errors']['album_id']
        );
    }    

    /** @test  */
    public function if_submitted_the_selected_album_id_must_be_greater_that_zero()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'album_id' => 0
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('album_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted album must be valid.',
            actualValidationMessage: $response['errors']['album_id']
        );
    }

    /** @test  */
    public function if_submitted_the_selected_album_id_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'album_id' => 999999
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('album_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted album does not exist in the database.',
            actualValidationMessage: $response['errors']['album_id']
        );
    }


    /** @test  */
    public function if_submitted_the_selected_tags_must_be_sent_as_an_array()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'tags' => 'ewrewr'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('tags');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted tag(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['tags']
        );
    }

    /** @test  */
    public function if_submitted_the_selected_tags_must_exist_in_the_database()
    {
        $track = Track::factory()->createOne();

        $response = $this->patchJson(
            route('cms.tracks.update', $track),
            [
                'tags' => [9998,9999]
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('tags');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted tag(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['tags']
        );
    }
}
