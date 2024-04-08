<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required|exists:user_roles,id',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'phone_area_code' => 'integer',
            'username' => 'string',
            'email' => 'required|email|unique:users,email',
            'birthday' => 'required|date_format:Y-m-d',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/',

            'street' => 'string',
            'city' => 'required',
            'province' => 'required',
            'region' => 'string',
            'zip_code' => 'required',
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.regex' => 'Uppercase, lowercase, and one number atleast.',
            'phone_number.required' => 'It should be 10 digits. Country code is not included.',
            'phone_number.digit' => 'It should be 10 digits country code is not included.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field should be a valid email.',
            'email.unique' => 'The email is already taken.',
            'birthday.required' => 'You must input your birthday',
        ];
    }
}
