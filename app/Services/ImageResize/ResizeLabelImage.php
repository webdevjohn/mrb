<?php 

namespace App\Services\ImageResize;

class ResizeLabelImage extends ImageResize {

    public function setUploadDirectory(string $directory = null): self
    {
        $this->uploadToDirectory = $directory ?? "_record-labels";

        return $this;
    }
}
