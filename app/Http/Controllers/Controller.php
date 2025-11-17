<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function response($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    protected function responseError($message, $status = 400)
    {
        return response()->json(['error' => $message], $status);
    }
}