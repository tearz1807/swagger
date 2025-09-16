<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

/**
 * @summary Update user
 *
 * @description current method use for update user
 *
 * @name update name for create user
 *
 * @email update email for user
 *
 * @password update password for user
 *
 * @id is required user id
 */

class UserUpdateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => 'email',
            'password' => 'string',
        ];
    }
}
