<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = $this->post ? ',' . $this->post->id : '';
        $required = $this->post ? '' : 'required';
        return [
            'photo'       => $required,
            'photo.*'     => 'image',
            'title'       => [$required, 'unique:posts,title' . $id, 'max:255'],
            'category_id' => 'required',
            'details'     => 'required',
            'tags'        => 'nullable|max:255'
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'photo.required'       => __('Image field is required.'),
            'photo.image'       => __('Image field must contain images.'),
            'title.required'       => __('Title field is required.'),
            'title.unique'         => __('This title has already been taken.'),
            'details.required'     => __('Details field is required.'),
            'category_id.required' => __('Category field is required.'),
        ];
    }
}
