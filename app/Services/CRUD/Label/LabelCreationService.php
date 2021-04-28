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

    public function create(array $requestInput)
    {     
        if (isset($requestInput['image'])) {
            
            $this->labelImageResize->setUp(
                $requestInput['image']
            );

            $this->labels->create(
                array_merge($requestInput, [
                    'slug' => Str::slug($requestInput['label']),
                    'label_image' => $this->labelImageResize->main(),
                    'label_thumbnail' => $this->labelImageResize->thumb()
                ])
            );

        } else {
            $this->labels->create(
                array_merge($requestInput, [
                    'slug' => Str::slug($requestInput['label']),
                ])
            );
        }
    }
}
