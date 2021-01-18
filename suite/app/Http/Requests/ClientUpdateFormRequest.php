<?php

namespace App\Http\Requests;

class ClientUpdateFormRequest extends ClientFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['avatar'] = 'nullable|mimes:jpg,jpeg,png,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=100,max_height=100';

        return $rules;
    }
}
