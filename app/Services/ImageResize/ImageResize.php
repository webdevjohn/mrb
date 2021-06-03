<?php 

namespace App\Services\ImageResize;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Illuminate\Filesystem\FilesystemManager;

abstract class ImageResize {

    protected UploadedFile $uploadedImage;

    protected string $uploadToDirectory, $imageType;
    
    protected int $width, $height, $quality;

    /**
     * Specify the name of the directory to upload the images to.
     *
     * @return string
     */
    abstract public function setUploadDirectory(string $directory = null): self;

    
    /**
     * @param ImageManager $image
     */
    public function __construct(
        protected ImageManager $image,
        protected FilesystemManager $storage
    ) {}


    public function uploadImage(UploadedFile $uploadedImage)
    {
        $this->uploadedImage = $uploadedImage;
    
        return $this;
    }


    public function toThumbnail(): self
    {
        $this->width = 240;   
        $this->height = 240;
        $this->imageType = 'thumbs';

        return $this;
    }


    public function toMain(): self
    {
        $this->width = 500;  
        $this->height = 500;
        $this->imageType = 'main';

        return $this;
    }


    public function create(string $imageType = 'thumbs', int $width = 240, int $height = 240, int $quality = 80): string
    {
        $this->createDirectoryFor($this->imageType ?? $imageType);

        return $this->image->make($this->uploadedImage->getPathname())
            ->resize(
                $this->width ?? $width, 
                $this->height ?? $height
            )
            ->save(
                $this->createPathFor($this->imageType ?? $imageType), 
                $this->quality ?? $quality
            )
            ->basename;
    }


    protected function createDirectoryFor(string $imageType)
    {
        if ( ! $this->storage->exists('public/images/' . $imageType . '/' . $this->uploadToDirectory)) {
            $this->storage->makeDirectory('public/images/' . $imageType . '/' . $this->uploadToDirectory, 0777, true);
        }        
    }


    protected function createPathFor(string $imageType): string
    {
        return public_path(). '/storage/images/'. $imageType . '/'. $this->uploadToDirectory 
            . '/' . $this->uploadedImage->getClientOriginalName();
    }
}
