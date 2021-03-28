<?php

namespace Tests\Feature\CMS\Admin\Validation\Album;

use App\Models\Album;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\AssertValidationErrorMessages;
use Tests\Traits\AuthAdminUser;

class RulesForAlbumUpdateTest extends TestCase
{
    use RefreshDatabase, AuthAdminUser, AssertValidationErrorMessages;
   
    /** @test  */
    public function a_title_is_required()
    {
       $album = Album::factory()->createOne();

       $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
    public function when_a_title_is_submitted_without_modification_the_title_must_be_unique_rule_is_ignored()
    {
        $album = Album::factory()->createOne();
  
        $this->patchJson(
            route('cms.albums.update', $album), array_merge(
                $album->toArray(),
                [
                    'title' => $album->title
                ]
            ))
            ->assertStatus(302);             
    }

    /** @test  */
    public function if_the_title_has_changed_the_updated_title_submitted_must_be_unique()
    {
        $album = Album::factory()->createOne();
        $album2 = Album::factory()->createOne();
        
        // attempt to update the title with a title that 
        // already exists in the database.
        $response = $this->patchJson(
            route('cms.albums.update', $album2), 
            [
                'title' => $album->title
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('title');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The submitted title is already in the database.',
            actualValidationMessage: $response['errors']['title']
        );
    }


    /** @test  */
    public function a_genre_is_required()
    {
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album), 
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
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


    /** @test  */
    public function the_use_track_artwork_checkbox_must_be_a_boolean()
    {
        $album = Album::factory()->createOne();

        $response = $this->patchJson(
            route('cms.albums.update', $album),
            [
                'use_track_artwork' => 'ewropew'
            ]
        )
        ->assertStatus(422)
        ->assertJsonValidationErrors('use_track_artwork');

        $this->assertValidationErrorMessage(
            expectedValidationMessage: 'The use track artwork checkbox must be either True or False.',
            actualValidationMessage: $response['errors']['use_track_artwork']
        );
    }
}
