<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
			$table->unsignedBigInteger('genre_id');
			$table->unsignedBigInteger('label_id');
			$table->unsignedBigInteger('format_id');
			$table->integer('year_released');
			$table->date('purchase_date');		
			$table->decimal('purchase_price', 5, 2);
			$table->unsignedBigInteger('key_code_id')->nullable();
			$table->decimal('bpm', 5, 2)->nullable();
			$table->string('track_thumbnail')->nullable();
			$table->string('track_image')->nullable();
			$table->string('mp3_sample_filename')->nullable();
			$table->string('full_track_filename')->nullable();
			$table->unsignedBigInteger('album_id')->nullable();
			$table->integer('played_counter')->nullable();
			$table->integer('viewed_counter')->nullable();
            $table->timestamps();

            #constraints
			$table->index('genre_id');                                               
            $table->foreign('genre_id')->references('id')->on('genres');
            
            $table->index('label_id');                                               
            $table->foreign('label_id')->references('id')->on('labels');
            
            $table->index('format_id');                                   
            $table->foreign('format_id')->references('id')->on('formats');

            $table->index('key_code_id');                                               
			$table->foreign('key_code_id')->references('id')->on('key_codes');
			
			$table->index('album_id');                                               
            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
