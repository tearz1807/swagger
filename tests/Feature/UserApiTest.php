<?php

namespace Tests\Feature;

use Tests\TestCaseApi;

class UserApiTest extends TestCaseApi
{
    /**
     * Test user delete.
     *
     * @return void
     */


    public function test_get_all(): void
    {
        $response = $this->setToken()->json('get', 'http://localhost/api/user');

        $response->assertStatus(200);
    }

    public function test_get(): void
    {
        $response = $this->setToken()->json('get', 'http://localhost/api/user/1');

        $response->assertStatus(200);
    }

    public function test_create(): void
    {
        $new_user = [
            'name' => 'create',
            'email' => 'test@create.ru',
            'password' => 'password'
        ];

        $response = $this->json('post', 'http://localhost/api/user', $new_user);
        $response->assertStatus(403);

        $response = $this->setToken()->json('post', 'http://localhost/api/user', $new_user);
        $response->assertStatus(201);

        $response = $this->json('post', 'http://localhost/api/user', $new_user);
        $response->assertStatus(500);
    }

    public function test_update(): void
    {
        $update_user = [
            'name' => 'Update',
            'email' => 'test@new.ru',
            'password' => 'password'
        ];

        $response = $this->json('put', 'http://localhost/api/user/2', $update_user);
        $response->assertStatus(403);

        $response = $this->setToken()->json('put', 'http://localhost/api/user/2', $update_user);
        $response->assertStatus(200);

        $response = $this->json('put', 'http://localhost/api/user/200', $update_user);
        $response->assertStatus(500);

    }

    public function test_delete(): void
    {
        $response = $this->json('delete', 'http://localhost/api/user/3');

        $response->assertStatus(403);

        $response = $this->setToken()->json('delete', 'http://localhost/api/user/3');

        $response->assertStatus(204);

        $response = $this->json('delete', 'http://localhost/api/user/3');

        $response->assertStatus(500);

    }
}
