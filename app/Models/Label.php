<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Label extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'labels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['label', 'slug', 'label_thumbnail', 'label_image'];

    // /**
    //  * Default attribute values.
    //  * @var array 
    // */
    // protected $attributes = [
    // 	'label_thumbnail' 	=> null,
    // 	'label_image'		=> null        
    // ];

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

    public function albums() 
	{
		return $this->hasMany(Album::class, 'label_id');
	}

	public function tracks() 
	{
		return $this->hasMany(Track::class, 'label_id');
	}

	public function userFavourites()
	{
		return $this->belongsToMany(User::class, 'favourite_label_user', 'user_id', 'label_id')->WithTimeStamps();
	}


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

    public function getLabelThumbnail()
	{
		if ($this->label_thumbnail) {
			return 'storage/images/thumbs/_record-labels/' . $this->label_thumbnail;
		}		
		return 'storage/images/thumbs/coming-soon.gif';
	}

	public function getLabelImage()
	{
		if ($this->label_image) {
			return 'storage/images/main/_record-labels/' . $this->label_image;
		}
		return "storage/images/main/ics-600.gif";	
	}


    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeWithFields($query)
	{
		return $query->select('id', 'label', 'slug', 'label_thumbnail', 'label_image');
	}

	public function scopeWithTrackCount($query, $genre)
	{
		return $query->join('tracks', 'tracks.label_id', '=', 'labels.id')
					 ->when($genre, function ($query) use ($genre) {
						return $query->where('tracks.genre_id', $genre);
					 })
					 ->groupBy('labels.label', 'labels.slug', 'labels.id', 'labels.label_image')					
					 ->orderBy('track_count', 'DESC')	
					 ->take(6)				
					 ->get(['labels.id', 'labels.label', 'labels.slug', 'labels.label_image', DB::raw('count(*) as track_count')]);						 				
	}

	public function scopeFilterByTracks($query, array $tracks)
	{
		return $query->whereHas('tracks', function($query) use ($tracks)
        {
            $query->whereIn('id', $tracks);              
		})
		->orderBy('label')
		->get();
	} 
}