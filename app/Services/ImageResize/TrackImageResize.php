<?php 

namespace App\Services\ImageResize;

use App\Models\Label;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class TrackImageResize {

    /**
     * @var UploadedFile
     */
    protected $uploadedImage;

    /**
     * @var string
     */
    protected string $originalFilename;

    /**
     * @var string
     */
    protected string $folder;


    /**
     * @param ImageManager $image
     * @param FilesystemManager $storage
     * @param Label $labels
     */
    public function __construct(
        protected ImageManager $image,
        protected FilesystemManager $storage,
        protected Label $labels
    ) {}


    public function setUp(UploadedFile $uploadedImage, int $labelId)
    {
        $this->uploadedImage = $uploadedImage;
        $this->originalFilename = $uploadedImage->getClientOriginalName();
        $this->folder = $this->labels->findOrFail($labelId)->slug;

        $this->createFolders();
    }


    public function main(int $width = 500, int $height = 500, int $quality = 80): string
    {
        $main = $this->image->make($this->uploadedImage->getPathname())
            ->resize($width, $height)
            ->save(
                public_path(). '/storage/images/main/' . $this->folder . '/' . $this->originalFilename, 
                $quality
            );

        return $main->basename;
    }


    public Function thumb(int $width = 230, int $height = 230, int $quality = 80): string
    {
        $thumb = $this->image->make($this->uploadedImage->getPathname())
            ->resize($width, $height)
            ->save(
                public_path(). '/storage/images/thumbs/' . $this->folder . '/' . $this->originalFilename,
                $quality
            );

        return $thumb->basename;
    }


    protected function createFolders()
    {
        if ( ! $this->storage->exists('public/images/main/' . $this->folder) ) {
            $this->storage->makeDirectory('public/images/main/' . $this->folder, 0777, true);
        }
         
        if ( ! $this->storage->exists('public/images/thumbs/' . $this->folder)) {
            $this->storage->makeDirectory('public/images/thumbs/' . $this->folder, 0777, true);
        }
    }
}
