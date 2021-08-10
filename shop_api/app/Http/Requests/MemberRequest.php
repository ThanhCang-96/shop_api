<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'name' => 'bail|required|max:50',
        'email' => 'bail|email|required',
        'password' => 'bail|min:8|max:20|nullable',
        'phone' => "bail|digits:10|required" , 
        'address' => "bail|max:100|required", 
        'avatar' => "bail|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048"
      ];
    }
}
