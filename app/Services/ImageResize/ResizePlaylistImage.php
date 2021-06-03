<?php 

namespace App\Services\ImageResize;

class ResizePlaylistImage extends ImageResize {

    public function setUploadDirectory(string $directory = null): self
    {
        $this->uploadToDirectory = $directory ?? "_playlists";

        return $this;
    }

    // 16:9 aspect ratio
    public function toThumbnail(): self
    {
        $this->width = 480;  
        $this->height = 270;
        $this->imageType = 'thumbs';

        return $this;
    }
}
