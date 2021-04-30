<?php

namespace App\Http\Requests\CMS\Tracks;

use App\Http\Requests\Request;

class UpdateTrack extends Request
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
            'title' => 'required|max:125',
            'genre_id' => 'required|numeric|min:1|exists:genres,id',  
            'label_id' => 'required|numeric|min:1|exists:labels,id',    
            'format_id' => 'required|numeric|min:1|exists:formats,id', 
            'year_released' => 'required|digits:4|numeric|min:1980|max:'.(date('Y')),
            'purchase_date' => 'required|date|date_format: "Y-m-d"',
            'purchase_price' => 'required|numeric|between:0,50',    

            // nullable fields.
            'key_code_id' => 'nullable|numeric|min:1|exists:key_codes,id',
            'bpm' => 'nullable|numeric|between:100.0,200.0',
            'album_id' => 'nullable|numeric|min:1|exists:albums,id',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
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
            'artists.required' => 'An artist is required.',
            'artists.exists' => 'The submitted artist(s) do not exist in the database.',
            'artists.array' => 'An artist is required.',
            
            'title.required' => 'A title is required.',
            'title.max' => 'A title must not exceed :max characters.',

            'genre_id.required' => 'A genre is required.',
            'genre_id.numeric' => 'A genre is required.',
            'genre_id.min' => 'A genre is required.',
            'genre_id.exists' => 'The submitted genre does not exist in the database.',
            
            'label_id.required' => 'A label is required.',
            'label_id.numeric' => 'A label is required.',
            'label_id.min' => 'A label is required.',
            'label_id.exists' => 'The submitted label does not exist in the database.',

            'format_id.required' => 'A format is required.',
            'format_id.numeric' => 'A format is required.',
            'format_id.min' => 'A format is required.',
            'format_id.exists' => 'The submitted format does not exist in the database.',

            'year_released.required' => 'The year of release is required.',
            'year_released.digits' => 'The submitted year of release must be exactly 4 digits in length.',
            'year_released.numeric' => 'The year of release must be numeric.',
            'year_released.min' => 'The submitted year of release must be greater than 1979.',
            'year_released.max' => 'The submitted year of release can not be in the future.',

            'purchase_date.required' => 'A purchase date is required.',
            'purchase_date.date' => 'The purchase date must be a valid date.',
            'purchase_date.date_format' => 'The purchase date must be in the yyyy-mm-dd format (e.g. 2020-12-18).',
      
            'purchase_price.required' => 'A purchase price is required.',
            'purchase_price.numeric' => 'A purchase price must be numeric.',
            'purchase_price.between' => 'A purchase price must be between :min - :max.',

            'bpm.numeric' => 'The BPM field must be numeric.',
            'bpm.between' => 'The BPM field must be between :min - :max.',

            'album_id.numeric' => 'The submitted album must be valid.',
            'album_id.min' => 'The submitted album must be valid.',
            'album_id.exists' => 'The submitted album does not exist in the database.',    
            
            'tags.exists' => 'The submitted tag(s) do not exist in the database.',
            'tags.array' => 'The submitted tag(s) do not exist in the database.'
        ];
    }
}
