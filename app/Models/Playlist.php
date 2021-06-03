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
		if ($this->thumbnail) {
			return 'storage/images/thumbs/_playlists/' . $this->thumbnail;
		}		
		return 'storage/images/thumbs/coming-soon.gif';
	}

	public function getImage()
	{
		if ($this->image) {
			return 'storage/images/main/_playlists/' . $this->image;
		}
		return "storage/images/main/ics-600.gif";	
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
