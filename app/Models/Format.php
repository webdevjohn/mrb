<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "formats";
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['format'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function albums()
	{
		return $this->hasMany(Album::class, 'format_id');
	}

	public function tracks()
	{
		return $this->hasMany(Track::class, 'format_id');
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
            $query->whereIn('id', $tracks);              
		})
		->orderBy('format')
		->get();
	}
}
