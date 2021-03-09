<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteTrackUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_track_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_id');                
            $table->unsignedBigInteger('user_id'); 
            $table->timestamps();
            
            #constraints
            $table->index('track_id');                                               
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');                

            $table->index('user_id');                                               
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourite_track_user');
    }
}
