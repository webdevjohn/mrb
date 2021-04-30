<?php 

namespace App\Services\CRUD\Track;

use App\Models\Track;
use App\Services\ImageResize\TrackImageResize;

class TrackCreationService {

    public function __construct(
        protected Track $tracks,
        protected TrackImageResize $trackImageResize
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
        
        if ($requestInput['tags']) {
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
        $this->trackImageResize->setUp(
            $requestInput['image'], $requestInput['label_id']
        );

        return $this->tracks->create(
            array_merge($requestInput, [   
                'track_image' => $this->trackImageResize->main(),
                'track_thumbnail' => $this->trackImageResize->thumb()
            ])
        );
    }
}
