<?php 

namespace App\Services\CRUD\Label;

use App\Models\Label;
use App\Services\ImageResize\LabelImageResize;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Str;

class LabelUpdateService {

    public function __construct(
        protected LabelImageResize $labelImageResize,
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
   
        $this->labelImageResize->setUp(
            $requestInput['image']
        );

        $label->fill(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['label']),
                'label_image' => $this->labelImageResize->main(),
                'label_thumbnail' => $this->labelImageResize->thumb()
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
        $main = 'public/images/main/_record-labels/' . $label->label_image;
        $thumb = 'public/images/thumbs/_record-labels/' . $label->label_thumbnail;

        if ($this->storage->exists($main)) {
            $this->storage->delete($main);
        }

        if ($this->storage->exists($thumb)) {
            $this->storage->delete($thumb);
        }
    }
}
