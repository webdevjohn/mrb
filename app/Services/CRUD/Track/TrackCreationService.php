<?php 

namespace App\Services\CRUD\Track;

use App\Models\Label;
use App\Models\Track;
use App\Services\ImageResize\ResizeTrackImage;

class TrackCreationService {

    public function __construct(
        protected Track $tracks,
        protected Label $labels,
        protected ResizeTrackImage $resizeImage
    ) {}


    /**
     * 
     * @param array $requestInput
     */
    public function create(array $requestInput)
    {     
        if (isset($requestInput['image'])) {
            $track = $this->createTrackWithImage($requestInput);
        } else {
            $track = $this->tracks->create($requestInput);   
        }

        $track->artists()->attach($requestInput['artists']);
        
        if (isset($requestInput['tags'])) {
            $track->tags()->attach($requestInput['tags']);
        }
    }


    /**
     * Create a new Track with uploaded image.
     *
     * @param array $requestInput
     * 
     * @return Track
     */
    protected function createTrackWithImage(array $requestInput): Track
    {
        $labelSlug = $this->labels->find($requestInput['label_id'])->slug;
        $this->resizeImage->setUploadDirectory($labelSlug)->uploadImage($requestInput['image']);

        return $this->tracks->create(
            array_merge($requestInput, [   
                'image' => $this->resizeImage->toMain()->create(),
                'thumbnail' => $this->resizeImage->toThumbnail()->create()
            ])
        );
    }
}
