<?php

namespace App\Http\Requests\Dashboard\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAddressUpdateRequest extends FormRequest
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
            'country' => 'required',
            'city' => 'required',
            'town' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ];
    }
}
