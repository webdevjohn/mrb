<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 125);   
            $table->string('slug', 125)->unique();    
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('label_id');
            $table->unsignedBigInteger('format_id');        
            $table->integer('year_released');
            $table->date('purchase_date');      
            $table->decimal('purchase_price', 5, 2);
            $table->string('album_thumbnail', 255)->nullable();
            $table->string('album_image', 255)->nullable();
            $table->boolean('use_track_artwork')->default(false);
            $table->timestamps();

            #constraints
            $table->index('genre_id');                                               
            $table->foreign('genre_id')->references('id')->on('genres');
            
            $table->index('label_id');                                               
            $table->foreign('label_id')->references('id')->on('labels');
            
            $table->index('format_id');                                   
            $table->foreign('format_id')->references('id')->on('formats');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
