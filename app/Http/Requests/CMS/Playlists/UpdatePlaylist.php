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
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|dimensions:ratio=16/9|max:255'
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
            'name.required' => 'A name is required.',
            'name.max' => 'A name must not exceed :max characters.',
            'name.unique' => 'The name submitted is already in the database.',
            
            'genre_id.required' => 'A genre is required.',
            'genre_id.numeric' => 'A genre is required.',
            'genre_id.min' => 'A genre is required.',
            'genre_id.exists' => 'The submitted genre does not exist in the database.',
        ];
    }
}
