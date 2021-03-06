<?php

namespace App\Http\Requests\CMS\Albums\Tracks;

use App\Http\Requests\Request;

class CreateAlbumTrack extends Request
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
            'artists' => 'required|array|exists:artists,id',
            'title' => 'required|max:50',
            'genre_id' => 'required|numeric|min:1|exists:genres,id',  
            'label_id' => 'required|numeric|min:1|exists:labels,id',    

            // nullable fields.
            'key_code_id' => 'nullable|numeric|min:1|exists:key_codes,id',
            'bpm' => 'nullable|numeric|between:100.0,200.0',        
            'thumbnail' => 'nullable',
            'image' => 'nullable',
            'mp3_sample_filename' => 'nullable',
            'full_track_filename' => 'nullable',
            'tags' => 'nullable|array|exists:tags,id'
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
            'artists.required' => 'An Artist is required.',
            'artists.exists' => 'The selected Artist(s) do not exist in the database.',
            'artists.array' => 'An Artist is required.',
            
            'title.required' => 'A Title is required.',
            'title.max' => 'A Title must not exceed 100 characters.',

            'genre_id.required' => 'A Genre is required.',
            'genre_id.numeric' => 'A Genre is required.',
            'genre_id.min' => 'A Genre is required.',
            'genre_id.exists' => 'The selected Genre does not exist in the database.',
            
            'label_id.required' => 'A Label is required.',
            'label_id.numeric' => 'A Label is required.',
            'label_id.min' => 'A Label is required.',
            'label_id.exists' => 'The selected Label does not exist in the database.',

            'format_id.required' => 'A Format is required.',
            'format_id.numeric' => 'A Format is required.',
            'format_id.min' => 'A Format is required.',
            'format_id.exists' => 'The selected Format does not exist in the database.',

            'year_released.required' => 'The Year Released field is required.',
            'year_released.numeric' => 'The Year Released field must be numeric.',
            'year_released.between' => 'The Year Released field must be between :min - :max.',

            'purchase_date.required' => 'The Purchase Date field is required.',
            'purchase_date.date' => 'The Purchase Date field must be a valid date.',
            'purchase_date.date_format' => 'The Purchase Date must be in the Y-m-d format (e.g. 2020-12-18).',
      
            'purchase_price.required' => 'The Purchase Price field is required.',
            'purchase_price.numeric' => 'The Purchase Price field must be numeric.',
            'purchase_price.between' => 'The Purchase Price field must be between :min - :max.',

            'bpm.numeric' => 'The BPM field must be numeric.',
            'bpm.between' => 'The BPM field must be between :min - :max.',

            'album_id.required' => 'An Album is required.',
            'album_id.numeric' => 'The selected Album must be valid.',
            'album_id.min' => 'The selected Album must be valid.',
            'album_id.exists' => 'The selected Album does not exist in the database.',    
            
            'tags.exists' => 'The selected Tag(s) do not exist in the database.',
            'tags.array' => 'The selected Tag(s) do not exist in the database.'
        ];
    }
}
