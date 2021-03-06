<?php 

namespace App\Services\CRUD\Label;

use App\Models\Label;
use App\Services\ImageResize\ResizeLabelImage;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Str;

class LabelUpdateService {

    public function __construct(
        protected ResizeLabelImage $resizeImage,
        protected FilesystemManager $storage
    ) {}


    /**
     *
     * @param array $requestInput
     * @param Label $label
     * 
     * @return void
     */
    public function update(array $requestInput, Label $label)
    {     
        if (isset($requestInput['image'])) {           
            return $this->updateLabelImage($requestInput, $label);
        }
  
        return $label->fill(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['label'])
            ])
        )->save();     
    }

    
    /**
     *
     * @param array $requestInput
     * @param Label $label
     * 
     * @return void
     */
    protected function updateLabelImage(array $requestInput, Label $label)
    {
        $this->deleteExistingImages($label);
   
        $this->resizeImage->setUploadDirectory()->uploadImage($requestInput['image']);

        $label->fill(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['label']),
                'image' => $this->resizeImage->toMain()->create(),
                'thumbnail' => $this->resizeImage->toThumbnail()->create()
            ])
        )->save();
    }


    /**
     *
     * @param Label $label
     * 
     * @return void
     */
    protected function deleteExistingImages(Label $label)
    {
        $main = 'public/images/main/_record-labels/' . $label->image;
        $thumb = 'public/images/thumbs/_record-labels/' . $label->thumbnail;

        if ($this->storage->exists($main)) {
            $this->storage->delete($main);
        }

        if ($this->storage->exists($thumb)) {
            $this->storage->delete($thumb);
        }
    }
}
