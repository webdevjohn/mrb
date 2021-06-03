<?php 

namespace App\Services\ImageResize;

class ResizeTrackImage extends ImageResize {

    public function setUploadDirectory(string $directory = null): self
    {
        $this->uploadToDirectory = $directory;

        return $this;
    }
}
