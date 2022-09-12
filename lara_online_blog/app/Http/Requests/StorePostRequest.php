<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create',Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|unique:posts,title|min:3",
            "category" => "required|integer|exists:categories,id",
            "description" => "required|min:20",
            "photos" => "required",
            "photos.*" => "file|max:3000|mimes:jpg,png",
            "tags" => "required",
            "tags.*" => "integer|exists:tags,id"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "ခေါင်စဥ်ထည့်လေးကွာ မင်းကလဲ ဘာညာ ..."
        ];
    }

}
