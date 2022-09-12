<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQualityRequest extends FormRequest
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
            "quality" => [
                'required',
                'unique:qualities,quality_name',
                'min:2',
                'max:5',
                Rule::in(['auto','240p','270p','360p','480p','720px','1080p','1440p','2160p','2K','4K']),
            ]
        ];
    }
}
