<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
          'title' => 'bail|required|max:50',
          'image' => 'bail|required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
          'description' => 'bail|required|min:10'
        ];
    }
}
