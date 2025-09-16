<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDestroyRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserIndexRequest $request)
    {
        $users = User::All();
        return $this->response(
            UserResource::collection($users)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(UserShowRequest $request, string $id)
    {
        $user = User::find($id);

        return $this->response(
            new UserResource($user)
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {

        $user = User::factory()->create($request->only([
            'email',
            'name',
            'password',
        ]));

        if ($user) {
            return $this->response(
                new UserResource($user),
                201
            );
        }

        return $this->responseError('Not create user');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);

        if ($user) {

            $user->forceFill($request->only([
                'email',
                'name',
                'password',
            ]));

            if ($user->save()) {
                return $this->response(
                    new UserResource($user)
                );
            }
        }
        return $this->responseError('Not update user');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDestroyRequest $request, string $id)
    {
        $user = User::find($id);

        if($user->delete()){
            return $this->response(['message' => 'User deleted successfully'], 204);
        }

        return $this->responseError('Not deleted');
    }
}
