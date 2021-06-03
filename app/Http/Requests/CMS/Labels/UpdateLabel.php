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
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|dimensions:ratio=1/1',
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
            'label.required' => 'A label is required.',
            'label.max' => 'A label must not exceed :max characters.',
            'label.unique' => 'The label submitted is already in the database.'
        ];
    }
}
