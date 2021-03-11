<?php

namespace App\Http\Requests\CMS\Genres;

use App\Http\Requests\Request;

class CreateGenre extends Request
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
            'genre' => 'required|max:35|unique:genres,genre'
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
            'genre.required' => 'A Genre is required.',
            'genre.max' => 'A Genre must not exceed :max characters.',
            'genre.unique' => 'The Genre specified is already in the database.'
        ];
    }
}