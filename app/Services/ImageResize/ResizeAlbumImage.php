<?php 

namespace App\Services\ImageResize;

class ResizeAlbumImage extends ImageResize {

    public function setUploadDirectory(string $directory = null): self
    {
        $this->uploadToDirectory = $directory ?? "_albums";

        return $this;
    }
}
