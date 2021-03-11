<?php

namespace App\Http\Requests\CMS\Albums;

use App\Http\Requests\Request;

class UpdateAlbum extends Request
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
            'title' => 'required|max:125',
            'genre_id' => 'required|numeric|min:1|exists:genres,id',  
            'label_id' => 'required|numeric|min:1|exists:labels,id',    
            'format_id' => 'required|numeric|min:1|exists:formats,id', 
            'year_released' => 'required|numeric|between:1980,2080', 
            'purchase_date' => 'required|date|date_format: "Y-m-d"',
            'purchase_price' => 'required|numeric|between:0,300',

            // nullable fields.
            'album_thumbnail' => 'nullable',
            'album_image' => 'nullable',
            'use_track_artwork' => 'nullable|boolean'  
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
            'title.required' => 'A Title is required.',
            'title.max' => 'A Title must not exceed :max characters.',

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

            'use_track_artwork.boolean' => 'The Use Track Artwork field must be either True or False.'
        ];
    }
}
