<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

/**
 * @summary Get all users
 *
 * @description get all users on db
 *
 *
 */

class UserListRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
