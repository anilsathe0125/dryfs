<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        $type_required = $this->item_type == 'digital' || $this->item_type == 'license' ? '' : 'required';

        $check_link = $this->file_type == 'link' ? 'required' : '';

        if ($this->item_type == 'digital') {
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'digital' && $this->file_type == 'file' ? 'required|' : '';
            }
        }elseif($this->item_type == 'license'){
            if($this->item){
                $check_file = '';
            }else{
                $check_file = $this->item_type == 'license' && $this->file_type == 'file' ? 'required|' : '';
            }
        }else{
            $check_file = '';
        }

        $id = $this->item ? ',' . $this->item->id : '';
        $required = $this->item ? '' : 'required|';

        return [
            'name' => 'required|max:255',
            'slug' => 'required','unique:items,slug' . $id, 'regex:pattern="/^[a-zA-Z0-9-]+$/"',
            'category_id' => 'required',
            'details' => 'required',
            'link' => $check_link,
            'file' => $check_file . 'file|mimes:zip',
            'short_details' => 'required|max:255',
            'discount_price' => 'required|numeric|max:9999999999',
            'prev_price' => 'numeric|max:9999999999',
            'stock' => $type_required . '|numeric|max:9999999999',
            'tax_id' => 'required',
            'photo' => $required . 'mimes:jpeg,png,jpg,svg',

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
            'name.required' => __('Name field is required.'),
            'tax_id.required' => __('Tax field is required.'),
            'category_id.required' => __('Category field is required.'),
            'brand_id.required' => __('Brand field is required.'),
            'slug.required' => __('Slug field is required.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'details.required' => __('Description field is required.'),
            'short_details.required' => __('Short Description field is required.'),
            'discount_price.required' => __('Current Price field is required.'),
            'stock.required' => __('Stock field is required.'),
            'photo.required' => __('Image field is required.'),
            'photo.mimes' => __('Image must be a file of type: jpeg, png, jpg, svg.'),
        ];
    }
}
