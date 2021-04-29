<?php 

namespace App\Services\CRUD\Label;

use App\Models\Label;
use App\Services\ImageResize\LabelImageResize;
use Illuminate\Support\Str;

class LabelCreationService {

    public function __construct(
        protected Label $labels,
        protected LabelImageResize $labelImageResize
    ) {}


    /**
     *
     * @param array $requestInput
     * 
     * @return Label
     */
    public function create(array $requestInput): Label
    {     
        if (isset($requestInput['image'])) {
            return $this->createLabelWithImage($requestInput);
        }
    
        return $this->labels->create(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['label']),
            ])
        );       
    }


    /**
     * Create a new Label with uploaded image.
     *
     * @param array $requestInput
     * 
     * @return Label
     */
    protected function createLabelWithImage(array $requestInput): Label
    {
        $this->labelImageResize->setUp(
            $requestInput['image']
        );

        return $this->labels->create(
            array_merge($requestInput, [
                'slug' => Str::slug($requestInput['label']),
                'label_image' => $this->labelImageResize->main(),
                'label_thumbnail' => $this->labelImageResize->thumb()
            ])
        );
    }
}
