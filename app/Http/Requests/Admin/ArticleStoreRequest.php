<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 * @summary Create new article
 * @description Create a new article (admin only)
 */
class ArticleStoreRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ];
    }
}