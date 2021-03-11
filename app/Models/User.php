<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function roles() 
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->WithTimeStamps();
    }

    public function favouriteArtists()
    {
        return $this->belongsToMany(Artist::class, 'favourite_artist_user', 'user_id', 'artist_id')->WithTimeStamps();
    }

    public function favouriteLabels()
    {
        return $this->belongsToMany(Label::class, 'favourite_label_user', 'user_id', 'label_id')->WithTimeStamps();
    }

    public function favouriteTracks()
    {
        return $this->belongsToMany(Track::class, 'favourite_track_user', 'user_id', 'track_id')->WithTimeStamps();
    }


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

    /**
     * Checks that a User has a given role.
     *
     * @param   string  $userHasRole
     * @return  boolean
     */
    public function hasRoleOf(string $userHasRole)
    {        
        foreach ($this->Roles as $role) 
        {        
            if (strtolower($role->role) == strtolower($userHasRole)) return true;        
        }
        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------   
    */

    /**
     * Add artists to the registered users favourites.
     *
     * @param array $artists
     * 
     * @return void
     */
    public function addArtistsToFavourites(array $artists)
    {
        if ($artists) {
            $this->favouriteArtists()->syncWithoutDetaching($artists);
        }
    }

    /**
     * Add record labels to the registered users favourites.
     *
     * @param array $labels
     * 
     * @return void
     */
    public function addLabelsToFavourites(array $labels)
    {
        if ($labels) {
            $this->favouriteLabels()->syncWithoutDetaching($labels);
        }
    }

    /**
     * Add tracks to the registered users favourites.
     *
     * @param array $tracks
     * 
     * @return void
     */
    public function addTracksToFavourites(array $tracks)
    {
        if ($tracks) {
            $this->favouriteTracks()->syncWithoutDetaching($tracks);
        }
    }
}
