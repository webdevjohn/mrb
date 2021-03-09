<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_track', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');
			$table->unsignedBigInteger('track_id');
            $table->timestamps();

            #constraints
			$table->index('artist_id');                                               
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');

	     	$table->index('track_id');                                               
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_track');
    }
}
