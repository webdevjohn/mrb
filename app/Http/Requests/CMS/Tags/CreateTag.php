<?php

namespace App\Http\Requests\CMS\Tags;

use App\Http\Requests\Request;

class CreateTag extends Request
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
            'tag'   => 'required|max:50|unique:tags,tag',
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
            'tag.required'  => 'A Tag is required.',
            'tag.max'       => 'A Tag must not exceed :max characters.',
            'tag.unique'    => 'The Tag specified is already in the database.'
        ];
    }
}