<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 * @summary Get article by ID
 * @description Retrieve specific article details
 */
class ArticleShowRequest extends AdminRequest
{
    public function rules(): array
    {
        return [];
    }
}