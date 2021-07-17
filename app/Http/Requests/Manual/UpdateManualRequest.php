<?php

namespace App\Http\Requests\Manual;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManualRequest extends FormRequest {

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
            'title'         => ['required'],
            'logo'          => ['nullable'],
            'banner'        => ['nullable'],
            'description'   => ['nullable'],
            'tags'          => ['nullable', 'array'],
            'tags.*'        => ['nullable', 'string'],
            'tutorials'     => ['nullable', 'array'],
            'tutorials.*'   => ['nullable'],
            'manual_status' => ['required'],
        ];
    }
}
