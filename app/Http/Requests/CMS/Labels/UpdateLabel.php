<?php

namespace App\Http\Requests\CMS\Labels;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateLabel extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {      
        return [            
            'label' => [
                'required', 
                'max:50', 
                Rule::unique('labels')->ignore($this->route('label')->id)
            ],        
            'label_thumbnail' => 'max:50',
            'label_image' => 'max:50'
        ];
    }

    /**
     * Get the custom error messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [        
            'label.required' => 'A Label is required.',
            'label.max' => 'A Label must not exceed :max characters.',
            'label.unique' => 'The Label specified is already in the database.',

            'label_thumbnail.max' => 'A Label Thumbnail must not exceed :max characters.',
            'label_image.max' => 'A Label Image must not exceed :max characters.'
        ];
    }
}
