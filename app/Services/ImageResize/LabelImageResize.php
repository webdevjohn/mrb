<?php 

namespace App\Services\ImageResize;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class LabelImageResize {

    /**
     * @var UploadedFile
     */
    protected $uploadedImage;

    /**
     * @var string
     */
    protected string $originalFilename;

    /**
     * @param ImageManager $image
     */
    public function __construct(
        protected ImageManager $image
    ) {}


    public function setUp(UploadedFile $uploadedImage)
    {
        $this->uploadedImage = $uploadedImage;
        $this->originalFilename = $uploadedImage->getClientOriginalName();

        return $this;
    }


    public function main(int $width = 500, int $height = 500, int $quality = 80): string
    {
        $main = $this->image->make($this->uploadedImage->getPathname())
            ->resize($width, $height)
            ->save(
                public_path(). '/storage/images/main/_record-labels/' . $this->originalFilename, 
                $quality
            );

        return $main->basename;
    }


    public Function thumb(int $width = 230, int $height = 230, int $quality = 80): string
    {
        $thumb = $this->image->make($this->uploadedImage->getPathname())
            ->resize($width, $height)
            ->save(
                public_path(). '/storage/images/thumbs/_record-labels/' . $this->originalFilename,
                $quality
            );

        return $thumb->basename;
    }
}
