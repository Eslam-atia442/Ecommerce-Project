<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Adminloginrequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required'

        ];
    }

    public function messages()
    {
        return [
          'email.required'=>'يجد ادحال الايميل',
          'email.email'=>'صيغه الايميل غير صحيحه',
          'password.required'=>'يجب ادحال الباسورد'
        ];
    }
}
