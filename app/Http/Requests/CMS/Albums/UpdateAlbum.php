<?php

namespace App\Http\Requests\CMS\Albums;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

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
            'title' => [
                'required',
                'max:125',
                Rule::unique('albums', 'title')->ignore($this->route('album')->id)   
            ],
            'genre_id' => 'required|numeric|min:1|exists:genres,id',  
            'label_id' => 'required|numeric|min:1|exists:labels,id',    
            'format_id' => 'required|numeric|min:1|exists:formats,id', 
            'year_released' => 'required|digits:4|numeric|min:1980|max:'.(date('Y')),
            'purchase_date' => 'required|date|date_format: "Y-m-d"',
            'purchase_price' => 'required|numeric|between:0,50',            

            // nullable fields.
            'thumbnail' => 'nullable|',
            'image' => 'nullable',
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
            'title.required' => 'A title is required.',
            'title.max' => 'A title must not exceed :max characters.',
            'title.unique' => 'The submitted title is already in the database.',

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

            'use_track_artwork.boolean' => 'The use track artwork checkbox must be either True or False.'
        ];
    }
}
