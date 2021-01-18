<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'email'         => 'required|email:rfc',
            'avatar'        => 'required|mimes:jpg,jpeg,png,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=100,max_height=100',
        ];
    }

    public function messages()
    {
        return [
            'avatar.dimensions' => 'The avatar has invalid image dimensions. Image size must be 100x100.'
        ];
    }
}
