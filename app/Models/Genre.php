<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
    */
 	protected $table = 'genres';

 	/**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['genre', 'slug'];
	
	public static function boot()
	{
		parent::boot();

        static::creating(function($genre) {            
            $genre->slug = Str::slug($genre->genre);
        });

		static::updating(function($genre) {            
        	$genre->slug = Str::slug($genre->genre);
        });
	}


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function albums() 
	{
		return $this->hasMany(Album::class, 'genre_id');
	}

	public function tracks() 
	{
		return $this->hasMany(Track::class, 'genre_id');
	}
    
    
    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeWithTrackCount($query)
	{
		return $query->join('tracks', 'tracks.genre_id', '=', 'genres.id')
			->groupBy('genres.id', 'genres.genre', 'genres.slug')	
			->orderBy('genres.genre')				
			->get([
				'genres.id', 
				'genres.genre', 
				'genres.slug', 
				DB::raw('count(*) as track_count'), 
				DB::raw('sum(tracks.purchase_price) as genre_cost')
			]);					
	}
	

	public function scopeFilterByTracks($query, array $tracks)
	{
		return $query->whereHas('tracks', function($query) use ($tracks)
        {
            $query->whereIn('id', $tracks);              
		})
		->orderBy('genre')
		->get();
	} 
}
