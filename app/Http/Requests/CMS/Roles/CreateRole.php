<?php

namespace App\Http\Requests\CMS\Roles;

use Illuminate\Foundation\Http\FormRequest;

class CreateRole extends FormRequest
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
            'role' => 'required|max:50|unique:roles,role',
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
            'role.required' => 'A role is required.',
            'role.max' => 'A role must not exceed :max characters.',
            'role.unique' => 'The role submitted is already in the database.'
        ];
    }
}
