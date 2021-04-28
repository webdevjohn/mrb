<?php 

namespace App\Services\CRUD\Label;

use App\Models\Label;
use App\Services\ImageResize\LabelImageResize;
use Illuminate\Support\Str;

class LabelUpdateService {

    public function __construct(
        protected LabelImageResize $labelImageResize
    ) {}

    public function update(array $requestInput, Label $label)
    {     
        if (isset($requestInput['image'])) {
            
            // to do... delete old image, if updated.

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

        } else {
            $label->fill(
                array_merge($requestInput, [
                    'slug' => Str::slug($requestInput['label'])
                ])
            )->save();
        }
    }
}
