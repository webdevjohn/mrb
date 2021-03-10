<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Artist extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "artists";
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['artist_name', 'slug'];

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

    public function tracks() 
	{
		return $this->belongsToMany(Track::class, 'artist_track', 'artist_id', 'track_id');
	}

	public function userFavourites()
	{
		return $this->belongsToMany(User::class, 'favourite_artist_user', 'user_id', 'artist_id')->WithTimeStamps();
	}


    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeWithTrackCount($query)
	{
		return $query->join('artist_track', 'artist_track.artist_id', '=', 'artists.id')
					 ->groupBy('artists.id', 'artists.artist_name', 'artists.slug')
					 ->select(['artists.id', 'artists.artist_name', 'artists.slug', DB::raw('count(*) as track_count')]);					 
	}


	public function scopeFilterByTracks($query, array $tracks)
	{
		return $query->whereHas('tracks', function($query) use ($tracks)
        {
            $query->whereIn('track_id', $tracks);              
		})
		->orderBy('artist_name')
		->get();
	} 
}
