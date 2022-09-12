<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'status' => 'required',
            'password' => 'required|min:4|max:255',
            "profile_photo" => "nullable|mimes:png,jpg|max:5000",
        ];
    }
}
