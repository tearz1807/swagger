<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @summary Авторизация пользователя
 *
 * @description Данный ендпоинт предназначен для получения ключа для последушющего использования в апи
 *
 * @_204 Successful
 *
 */

class UserGetRequest extends FormRequest
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
            //
        ];
    }
}
