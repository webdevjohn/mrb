<?php

namespace App\Models;

use App\Models\Traits\CountableViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

	public static function boot()
	{
		parent::boot();

        static::creating(function($playlist) {            
            $playlist->slug = Str::slug($playlist->name);
        });

		static::updating(function($playlist) {            
        	$playlist->slug = Str::slug($playlist->name);
        });
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

    public function getTrackIds()
	{
		return $this->tracks->pluck('id')->toArray();
	}

	public function popular(int $take = 4)
	{
		return $this->orderBy('viewed_counter', 'DESC')
			->take($take)
			->get();
	}
}
