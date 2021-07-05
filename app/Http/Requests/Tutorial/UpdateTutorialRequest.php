<?php

namespace App\Http\Requests\Tutorial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorialRequest extends FormRequest
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
            'title'                => ['required'],
            'main_image'           => ['required'],
            'description'          => ['required'],
            'difficulty'           => ['required'],
            'duration'             => ['required'],
            'duration_measurement' => ['required'],
            'tags'                 => ['array'],
            'tags.*'               => ['required', 'string'],
            'area'                 => ['required'],
            'introduction'         => ['nullable'],
            'introduction_video'   => ['nullable'],
            'steps'                => ['array'],
            'steps.*.step_images'  => ['nullable'],
            'steps.*.step_order'   => ['required', 'numeric'],
            'steps.*.step_title'   => ['required', 'string'],
            'steps.*.step_content' => ['nullable', 'string'],
            'tutorial_status'      => ['required'],
        ];
    }
}
