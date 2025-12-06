<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 * @summary Get list of articles
 * @description Retrieve paginated list of articles for admin
 */
class ArticleIndexRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'is_published' => 'sometimes|boolean',
        ];
    }
}