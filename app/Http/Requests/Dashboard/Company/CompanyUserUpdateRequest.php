<?php

namespace App\Http\Requests\Dashboard\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUserUpdateRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|email|unique:users,email,{$this->user->id}",
            'password' => 'sometimes|required|confirmed|min:6'
        ];
    }
}
