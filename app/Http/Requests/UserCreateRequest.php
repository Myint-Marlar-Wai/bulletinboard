<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
            'type' => 'required',
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

            'name' => 'Name is required',
            'email' => 'Email is required',
            'password' => 'Password is required',
            'type' => 'Type is required',
      ];
  }
}
