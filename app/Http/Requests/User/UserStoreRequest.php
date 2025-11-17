<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

/**
 * @summary Create user
 *
 * @description current method use for create user
 *
 * @name required name for create user
 *
 * @email required email for create user
 *
 * @password required password for create user
 */
class UserStoreRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email already exists',
        ];
    }
}