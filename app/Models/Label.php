<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

	public static function boot()
	{
		parent::boot();

        static::creating(function($item) {            
            $item->slug = Str::slug($item->label);
        });

		static::updating(function($item) {            
        	$item->slug = Str::slug($item->label);
        });
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

	/**
	 * Returns a count of the number of records.
	 *
	 * @return int 
	 */
	public function getModelCount(): int
	{
		return $this->count();
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

	public function scopeWithTrackCount($query, int $genre = null)
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

	public function scopeGetPaginated()
	{
		return $this->has('tracks')
			->WithFields()
			->orderBy('label')
			->paginate(48);
	}
}
