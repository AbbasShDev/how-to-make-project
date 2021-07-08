<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest {

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
            'title'          => ['required'],
            'main_image'     => ['required'],
            'description'    => ['required'],
            'tags'           => ['nullable','array'],
            'tags.*'         => ['nullable', 'string'],
            'article'        => ['required', 'string'],
            'article_status' => ['required'],
        ];
    }
}
