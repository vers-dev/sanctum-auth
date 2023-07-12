<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required']
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
            'email.required' => 'An email is required',
            'password.required' => 'A password is required',
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
        throw new ApiException($errors->first(), 422);
    }
}
