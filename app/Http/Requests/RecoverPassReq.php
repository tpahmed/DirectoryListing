<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecoverPassReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'password'=>[
                'required',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'cpassword'=>'same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'password.required'=>'Please enter your PassWord',
            'password.min'=>"
                Your PassWord Must contain :
                    - at least 10 characters in length
                    - at least one lowercase letter
                    - at least one uppercase letter
                    - at least one digit
                    - a special character
            ",
            'password.regex'=>"
                Your PassWord Must contain :
                    - at least 10 characters in length
                    - at least one lowercase letter
                    - at least one uppercase letter
                    - at least one digit
                    - a special character
            ",
            'cpassword.same'=>'passwords must be identical'

        ];
    }
}
