<?php 

namespace App\Services\CRUD\Track;

use App\Models\Track;
use App\Services\ImageResize\TrackImageResize;
use Illuminate\Filesystem\FilesystemManager;

class TrackUpdateService {

    public function __construct(
        protected TrackImageResize $trackImageResize,
        protected FilesystemManager $storage
    ) {}


    /**
     * 
     * @param array $requestInput
     */
    public function update(array $requestInput, Track $track)
    {     
        if (isset($requestInput['image'])) {
            $this->updateTrackWithImage($requestInput, $track);
        } else {
            $track->fill($requestInput)->save();   
        }

        $track->artists()->sync($requestInput['artists']);	
 
        $track->tags()->sync($requestInput['tags'] ?? null);        
    }


    /**
     * Update an existing Track with image.
     *
     * @param array $requestInput
     * 
     * @return void
     */
    protected function updateTrackWithImage(array $requestInput, Track $track)
    {    
        $this->deleteExistingImages($track);

        $this->trackImageResize->setUp(
            $requestInput['image'], $requestInput['label_id']
        );

        $track->fill(
            array_merge($requestInput, [   
                'image' => $this->trackImageResize->main(),
                'thumbnail' => $this->trackImageResize->thumb()
            ])
        )->save();
    }

    /**
     *
     * @param Track $track
     * 
     * @return void
     */
    protected function deleteExistingImages(Track $track)
    {
        $main = "public/images/main/" . $track->label->slug . "/" . $track->image;
        $thumb = "public/images/thumbs/" . $track->label->slug . "/" . $track->thumbnail;

        if ($this->storage->exists($main)) {
            $this->storage->delete($main);
        }

        if ($this->storage->exists($thumb)) {       
            $this->storage->delete($thumb);
        }
    }
}
