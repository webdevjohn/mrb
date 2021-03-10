<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

        /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['tag'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function tracks() 
    {
        return $this->belongsToMany(Track::class, 'tag_track', 'tag_id', 'track_id');
    }


    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */
    
	public function scopeFilterByTracks($query, array $tracks)
	{
		return $query->whereHas('tracks', function($query) use ($tracks)
        {
            $query->whereIn('track_id', $tracks);              
		})
		->orderBy('tag')
		->get();
	} 
}
