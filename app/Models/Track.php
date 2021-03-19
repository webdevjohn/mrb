<?php

namespace App\Models;

use App\Models\Traits\CountablePlays;
use App\Models\Traits\CountableViews;
use App\Models\Traits\Paginateable;
use App\Models\Traits\Sortable;
use App\Models\Traits\Track\AdminCMSQueries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webdevjohn\Filterable\Traits\Filterable;

class Track extends Model
{
    use HasFactory, Paginateable, Filterable, Sortable, CountableViews, CountablePlays, AdminCMSQueries;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "tracks";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['title','genre_id','label_id','format_id','year_released',
							'purchase_date','purchase_price','key_code_id','bpm','album_id','track_thumbnail',
								'track_image','mp3_sample_filename','full_track_filename'];


	/**
	 * The fields that can be dynamically sorted.
	 *
	 * @var array
	 */							
	protected $sortableFields = ['year_released', 'popularity'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function album()
	{
		return $this->belongsTo(Album::class, 'album_id');
	}

	public function artists() 
	{
		return $this->belongsToMany(Artist::class, 'artist_track', 'track_id', 'artist_id')->WithTimeStamps();
	}

	public function format()
	{
		return $this->belongsTo(Format::class, 'format_id');
	}

	public function genre()
	{
		return $this->belongsTo(Genre::class, 'genre_id');
	}
	
	public function keyCode()
	{
		return $this->belongsTo(KeyCode::class, 'key_code_id');
	}

	public function label()
	{
		return $this->belongsTo(Label::class, 'label_id');
	}

	public function playlists() 
	{
		return $this->belongsToMany(Playlist::class, 'playlist_track', 'track_id', 'playlist_id')->WithTimeStamps();
	}

	public function tags() 
	{
		return $this->belongsToMany(Tag::class, 'tag_track', 'track_id', 'tag_id')->WithTimeStamps();
	}

	public function userFavourites()
	{
		return $this->belongsToMany(User::class, 'favourite_track_user', 'user_id', 'track_id')->WithTimeStamps();
	}


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

	
    /**
	 * Returns a track thumbnail, if available.  
	 * Otherwise will return Label thumbnail.
	 * 
	 * @return string url to image.
	 */
	protected function getTrackArtwork()
	{
		if ($this->track_thumbnail) {
			return 'storage/images/thumbs/' . $this->label->slug . "/" . $this->track_thumbnail;
		}
		return $this->label->getLabelThumbnail(); 
	}

	/**
	 * Returns indivlual artwork for each album track,
	 * where use_track_artwork (Album model) is set to true.  
	 * 
	 * Otherwise uses album artwork for each track.
	 * 
	 * @return string url to album / track image.
	 */
	protected function getAlbumArtwork()
	{
		if ($this->album_id && $this->album->useTrackArtwork()) return $this->getTrackArtwork();

		if ($this->album_id) return $this->album->getThumbnail();
	}

	/**
	 * Determines whether album or track artwork should be returned.
	 * 
	 * @return string url to track thumbnail.
	 */
	public function getTrackThumbnail()
	{
		if ($this->album_id) return $this->getAlbumArtwork();
				
		return $this->getTrackArtwork();		
	}
	
	/**
	 * Returns a track MP3 url.
	 *
	 * @return string url to track MP3.
	 */
	public function getTrackMp3Sample()
	{
		if ($this->album_id) {
			return "/samples/albums/" . $this->album->getSlug() ."/". $this->mp3_sample_filename;
		}
		return "/samples/" . $this->genre->slug . "/" . $this->mp3_sample_filename;
	}



    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeFilters($query, $request)
	{
		return $this->getFilterFactory('TrackFilters')->make($query, $request);
	}

	public function scopeWithTrackReportingFields($query)
	{
		return $query->select('id', 'title', 'genre_id', 'label_id', 'format_id', 'year_released', 
								'purchase_date', 'mp3_sample_filename', 'track_thumbnail', 'track_image');
	}

	public function scopeWithRelations($query)
	{
		return $query->with('artists', 'label', 'genre', 'tags', 'album', 'album.label');
	}

	public function scopeReleaseYears($query, $trackIds)
	{
		return $query->groupBy('year_released')
            ->whereIn('id', $trackIds)
            ->orderBy('year_released', 'desc')
            ->get(['year_released']);       
	}

	public function scopePopular($query, $take = 12)
	{
		return $query->WithRelations()							    	
			->orderBy('played_counter', 'DESC')
			->take($take)
			->get();
	}
}
