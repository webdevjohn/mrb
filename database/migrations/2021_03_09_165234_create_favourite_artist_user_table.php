<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteArtistUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_artist_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id');                
            $table->unsignedBigInteger('user_id'); 
            $table->timestamps();
            
            #constraint
            $table->index('artist_id');                                               
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');                

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
        Schema::dropIfExists('favourite_artist_user');
    }
}
