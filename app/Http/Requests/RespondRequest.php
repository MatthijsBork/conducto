<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RespondRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Een naam is vereist',
            'message.required' => 'Een bericht is vereist',
            'email.required' => 'Een E-mail is vereist',

            'email.email' => 'E-mail is niet geldig',
        ];
    }
}
