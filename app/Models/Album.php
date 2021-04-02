<?php

namespace App\Models;

use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webdevjohn\Filterable\Traits\Filterable;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory, Filterable, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "albums";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['title', 'slug', 'genre_id','label_id','format_id','year_released',
							'purchase_date','purchase_price','album_thumbnail', 'album_image', 'use_track_artwork'];

	public static function boot()
	{
		parent::boot();

        static::creating(function($album) {            
            $album->slug = Str::slug($album->title);
        });

		static::updating(function($album) {            
        	$album->slug = Str::slug($album->title);
        });
	}


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function format()
	{
		return $this->belongsTo(Format::class, 'format_id');
	}

	public function genre()
	{
		return $this->belongsTo(Genre::class, 'genre_id');
	}

	public function label()
	{
		return $this->belongsTo(Label::class, 'label_id');
	}

	public function tracks()
	{
		return $this->hasMany(Track::class, 'album_id');
	}


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

    public function getThumbnail()
	{
		if ($this->album_thumbnail) {
			return 'storage/images/thumbs/_albums/' . $this->album_thumbnail;
		}
		return $this->label->getLabelThumbnail(); 
	}

	public function getAlbumImage()
	{
		if ($this->album_image) {
			return 'storage/images/main/_albums/' . $this->album_image;
		}	
		return $this->label->getLabelImage(); 
	}

    /**
	 * Returns the slug.
	 * 
	 * @return string slug
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	public function useTrackArtwork()
	{
		if ($this->use_track_artwork){
			return true;
		}
		return false;
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

    public function scopeFilters($query, $request)
	{
		return $this->getFilterFactory('AlbumFilters')->make($query, $request);
	}
}
