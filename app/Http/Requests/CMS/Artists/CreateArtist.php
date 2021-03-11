<?php

namespace App\Http\Requests\CMS\Artists;

use App\Http\Requests\Request;

class CreateArtist extends Request
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
            'artist_name' => 'required|max:50|unique:artists,artist_name',
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
            'artist_name.required' => 'An Artist Name is required.',
            'artist_name.max' => 'An Artist Name must not exceed :max characters.',
            'artist_name.unique' => 'The Artist Name specified is already in the database.',
        ];
    }
}