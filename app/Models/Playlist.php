<?php

namespace App\Models;

use App\Models\Traits\CountableViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory, CountableViews;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'playlists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['name', 'slug', 'genre_id', 'thumbnail', 'image'];

    /**
     * Path of the playlist artwork.
     *
     * @var string
     */
    protected $imagePath = "images/playlists/";

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function genre()
	{
		return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function tracks() 
    {
        return $this->belongsToMany(Track::class, 'playlist_track', 'playlist_id', 'track_id')->WithTimeStamps();
    }


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

    public function getThumbnail()
    {
        if ($this->thumbnail) return $this->imagePath . "thumb/" . $this->thumbnail;
        return $this->imagePath . "thumb/image_coming_soon.gif";
    }
    
    public function getImage()
    {
        return $this->imagePath . "main/" . $this->image;
    }
}
