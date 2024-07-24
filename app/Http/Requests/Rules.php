<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Captcha;
class Rules extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_client' => 'required',
            'email_client' => 'required',
            'password_client' => 'required',
            'address_client' => 'required',
            'phone_client' => 'required',
            'g-recaptcha' => new Captcha(),
        ];
    }
    public function messages(){
        return [
            'name_client.required' => 'required',
            'email_client' => 'required',
            'password_client' => 'required',
            'address_client' => 'required',
            'phone_client' => 'required',
            'g-recaptcha-response' => new Captcha(),
        ];
    }
}
