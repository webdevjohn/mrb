<?php

namespace App\Http\Requests\CMS\Formats;

use App\Http\Requests\Request;

class CreateFormat extends Request
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
            'format' => 'required|max:25|unique:formats,format'
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
            'format.required' => 'A Format is required.',
            'format.max' => 'A Format must not exceed :max characters.',
            'format.unique' => 'The Format specified is already in the database.'
        ];
    }
}