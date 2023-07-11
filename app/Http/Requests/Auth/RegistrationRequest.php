<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'min:6', 'max:255']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Field Name is required',
            'name.max' => 'Name can be max 255 chars',
            'email.required' => 'An email is required',
            'email.unique' => 'An email is already taken',
            'email.email' => 'An email is not valid',
            'password.required' => 'A password is required',
            'password.min' => 'A password length must be at least 6 chars',
        ];
    }

    /**
     * @param Validator|\Illuminate\Contracts\Validation\Validator $validator
     * @return mixed
     * @throws ApiException
     */
    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): mixed
    {
        $errors = $validator->errors();
        throw new ApiException($errors->first());
    }
}
