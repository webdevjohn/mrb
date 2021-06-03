<?php 

namespace App\Services\CRUD\Playlist;

use App\Models\Playlist;
use App\Services\ImageResize\ResizePlaylistImage;
use Illuminate\Support\Str;

class PlaylistCreationService {

    public function __construct(
        protected Playlist $playlists,
        protected ResizePlaylistImage $resizeImage
    ) {}


    /**
     *
     * @param array $requestInput
     * 
     * @return Playlist
     */
    public function create(array $requestInput): Playlist
    {     
        if (isset($requestInput['image'])) {
            return $this->createPlaylistWithImage($requestInput);
        }
    
        return $this->playlists->create(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['name']),
            ])
        );       
    }


    /**
     * Create a new Playlist with uploaded image.
     *
     * @param array $requestInput
     * 
     * @return Playlist
     */
    protected function createPlaylistWithImage(array $requestInput): Playlist
    {
        $this->resizeImage->setUploadDirectory()->uploadImage($requestInput['image']);

        return $this->playlists->create(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['name']),               
                'thumbnail' => $this->resizeImage->toThumbnail()->create()
            ])
        );
    }
}
