<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
        $id = $this->staff ? ',' . $this->staff->id : '';
        $required = $this->staff ? '' : 'required|';
        $password = $this->staff ? 'nullable|min:8|max:16' : 'required|min:8|max:16';
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:admins,email' . $id,
            'phone' => 'required|max:20',
            'password' => $password,
            'role_id' => 'required',
            'photo' => $required . 'image|mimes:jpeg,jpg,png,svg',
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
            'email.unique'     => __('This email has already been taken.'),
            'photo.required'   => __('Image field is required.'),
            'photo.mimes'      => __('Image type must be jpg,jpeg,png,svg.'),
            'role_id.required' => __('Role field is required.'),
        ];
    }
}
