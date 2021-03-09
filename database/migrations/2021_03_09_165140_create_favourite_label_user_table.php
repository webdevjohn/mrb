<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteLabelUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_label_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('label_id');                
            $table->unsignedBigInteger('user_id'); 
            $table->timestamps();
            
            #constraints
            $table->index('label_id');                                               
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');                

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
        Schema::dropIfExists('favourite_label_user');
    }
}
