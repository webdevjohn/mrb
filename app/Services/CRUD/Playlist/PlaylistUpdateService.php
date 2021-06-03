<?php 

namespace App\Services\CRUD\Playlist;

use App\Models\Playlist;
use App\Services\ImageResize\ResizePlaylistImage;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Str;

class PlaylistUpdateService {

    public function __construct(
        protected ResizePlaylistImage $resizeImage,
        protected FilesystemManager $storage
    ) {}


    /**
     *
     * @param array $requestInput
     * @param Playlist $playlist
     * 
     * @return void
     */
    public function update(array $requestInput, Playlist $playlist)
    {     
        if (isset($requestInput['image'])) {           
            return $this->updatePlaylistImage($requestInput, $playlist);
        }
  
        return $playlist->fill(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['name'])
            ])
        )->save();     
    }

    
    /**
     *
     * @param array $requestInput
     * @param Playlist $playlist
     * 
     * @return void
     */
    protected function updatePlaylistImage(array $requestInput, Playlist $playlist)
    {
        $this->deleteExistingImages($playlist);
   
        $this->resizeImage->setUploadDirectory()->uploadImage($requestInput['image']);

        $playlist->fill(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['name']),
                'thumbnail' => $this->resizeImage->toThumbnail()->create()
            ])
        )->save();
    }


    /**
     *
     * @param Playlist $playlist
     * 
     * @return void
     */
    protected function deleteExistingImages(Playlist $playlist)
    {
        $main = 'public/images/main/_playlists/' . $playlist->image;
        $thumb = 'public/images/thumbs/_playlists/' . $playlist->thumbnail;

        if ($this->storage->exists($main)) {
            $this->storage->delete($main);
        }

        if ($this->storage->exists($thumb)) {
            $this->storage->delete($thumb);
        }
    }
}
