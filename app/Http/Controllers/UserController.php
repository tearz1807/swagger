<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\UserGetRequest;
use App\Http\Requests\User\UserListRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserListRequest $request)
    {
        $users = User::All();
        $item = UserResource::collection($users);
        return response()->json($item);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(['create'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['deleted'=>true]);
    }
}
