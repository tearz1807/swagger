<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 * @summary Delete article
 * @description Delete article (admin only)
 */
class ArticleDestroyRequest extends AdminRequest
{
    public function rules(): array
    {
        return [];
    }
}