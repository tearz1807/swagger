<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 * @summary Update article
 * @description Update existing article (admin only)
 */
class ArticleUpdateRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image' => 'nullable|string',
            'is_published' => 'sometimes|boolean',
        ];
    }
}