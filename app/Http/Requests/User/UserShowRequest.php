<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

/**
 * @summary User info by id
 *
 * @description Show user by id
 *
 * @id is required
 */

class UserShowRequest extends ApiRequest
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
