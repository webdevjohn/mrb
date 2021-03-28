<?php

namespace App\Http\Requests\CMS\Artists;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateArtist extends Request
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
            'artist_name' => [
                'required',
                'max:50',
                Rule::unique('artists')->ignore($this->route('artist')->id)        
            ]    
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
            'artist_name.required' => 'An artist name is required.',
            'artist_name.max' => 'An artist name must not exceed :max characters.',
            'artist_name.unique' => 'The artist name submitted is already in the database.'
        ];
    }
}
