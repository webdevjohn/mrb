<?php

namespace App\Http\Requests\CMS\Playlists;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdatePlaylist extends Request
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
            'name' => [
                'required',
                'max:100',
                Rule::unique('playlists')->ignore($this->route('playlist')->id)
            ],    
            'genre_id' => 'required|numeric|min:1|exists:genres,id',  
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
            'name.required' => 'A Name is required.',
            'name.max' => 'A Name must not exceed :max characters.',
            'name.unique' => 'The Playlist name specified is already in the database.',
            
            'genre_id.required' => 'A Genre is required.',
            'genre_id.numeric' => 'A Genre is required.',
            'genre_id.min' => 'A Genre is required.',
            'genre_id.exists' => 'The selected Genre does not exist in the database.',
        ];
    }
}
