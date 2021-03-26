<?php

namespace Tests\Feature\CMS\Admin\Validation\Track;

use Tests\TestCase;
use Tests\Traits\AuthAdminUser;
use Tests\Traits\AssertValidationErrorMessages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RulesForTrackCreationTest extends TestCase
{
    use AuthAdminUser, RefreshDatabase, AssertValidationErrorMessages;

    protected $endpoint = '/cms/tracks';

    /** @test  */
    public function an_artist_is_required()
    {
        $response = $this->postJson($this->endpoint, [
            'artists' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'artists' => 'ewrewr'
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('artists');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'An artist is required.',
            actualValidationMessage: $response['errors']['artists']
        );
    }

    /** @test  */
    public function the_selected_artists_must_exist_in_the_database()
    {
        $response = $this->postJson($this->endpoint, [
            'artists' => [99999, 99998]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('artists');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted artist(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['artists']
        );
    }


    /** @test  */
    public function a_title_can_not_be_null()
    {
        $response = $this->postJson($this->endpoint, [
            'title' => null
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('title');
        
        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A title is required.',
            actualValidationMessage: $response['errors']['title']
        );
    }

    /** @test  */
    public function the_title_must_not_exceed_125_characters()
    {
        $response = $this->postJson($this->endpoint, [
            'title' => str::random(126)
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 0
        ])
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
        $response = $this->postJson($this->endpoint, [
            'genre_id' => 9999
        ])
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
        $response = $this->postJson($this->endpoint, [
            'label_id' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'label_id' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'label_id' => 0
        ])
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
        $response = $this->postJson($this->endpoint, [
            'label_id' => 9999
        ])
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
        $response = $this->postJson($this->endpoint, [
            'format_id' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'format_id' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'format_id' => 0
        ])
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
        $response = $this->postJson($this->endpoint, [
            'format_id' => 9999
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('format_id');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted format does not exist in the database.',
            actualValidationMessage: $response['errors']['format_id']
        );
    }


    /** @test  */
    public function a_year_released_is_required()
    {
        $response = $this->postJson($this->endpoint, [
            'year_released' => null
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'A year released is required.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_released_must_be_exactly_4_digits_in_length()
    {
        $response = $this->postJson($this->endpoint, [
            'year_released' => 19801
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted year of release must be exactly 4 digits in length.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }


    /** @test  */
    public function the_submitted_year_released_must_be_numeric()
    {
        $response = $this->postJson($this->endpoint, [
            'year_released' => 'qoiwjreoi'
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('year_released'); 

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The year released must be numeric.',
            actualValidationMessage: $response['errors']['year_released']
        );
    }

    /** @test  */
    public function the_submitted_year_released_can_not_be_before_1980()
    {
        $response = $this->postJson($this->endpoint, [
            'year_released' => 1979
        ])
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
        $response = $this->postJson($this->endpoint, [
            'year_released' => 2022
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_date' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_date' => '2019-21-21'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_date' => '01-01-2020'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_price' => null
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_price' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_price' => -1
        ])
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
        $response = $this->postJson($this->endpoint, [
            'purchase_price' => 51
        ])
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
        $response = $this->postJson($this->endpoint, [
            'bpm' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'bpm' => 99
        ])
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
        $response = $this->postJson($this->endpoint, [
            'bpm' => 200.5
        ])
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
        $response = $this->postJson($this->endpoint, [
            'album_id' => 'qoiwjreoi'
        ])
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
        $response = $this->postJson($this->endpoint, [
            'album_id' => 0
        ])
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
        $response = $this->postJson($this->endpoint, [
            'album_id' => 999999
        ])
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
        $response = $this->postJson($this->endpoint, [
            'tags' => 'ewrewr'
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('tags');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The selected tag(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['tags']
        );
    }

    /** @test  */
    public function if_submitted_the_selected_tags_must_exist_in_the_database()
    {
        $response = $this->postJson($this->endpoint, [
            'tags' => [9998,9999]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('tags');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The selected tag(s) do not exist in the database.',
            actualValidationMessage: $response['errors']['tags']
        );
    }
}
