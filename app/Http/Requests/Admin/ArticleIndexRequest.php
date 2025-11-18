<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @summary Get list of articles
 * @description Retrieve paginated list of articles for admin
 */
class ArticleIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'is_published' => 'sometimes|boolean',
        ];
    }
}