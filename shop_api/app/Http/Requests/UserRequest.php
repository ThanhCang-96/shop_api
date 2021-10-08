<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
      'name' => "bail|required|max:50|nullable",
      'email' => "bail|required|email|nullable",
      // email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
      'password => "bail|min:8|max:20|nullable',
      'password_confirm' => "bail|min:8|max:20|same:password",
      'phone' => "bail|digits:10|nullable" , 
      'address' => "bail|max:100|nullable", 
      'avatar' => "bail|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048"
    ];
  }
}
