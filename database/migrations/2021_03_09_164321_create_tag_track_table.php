<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_track', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
			$table->unsignedBigInteger('track_id');
            $table->timestamps();

            #constraints
			$table->index('tag_id');                                               
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

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
        Schema::dropIfExists('tag_track');
    }
}
