<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user');
        return [
            'name' => 'required|min:3|max:100',
            'email' => 'required|unique:users,email,'. $id,
            'role' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:4|max:255',
            "profile_photo" => "nullable|mimes:png,jpg|max:5000",
        ];
    }
}
