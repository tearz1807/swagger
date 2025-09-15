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

    public function test_delete(): void
    {
        $this->withoutMiddleware();
        $response = $this->withBearer()->json('delete', 'http://localhost/api/user/1');

        $response->assertStatus(200);

        $response = $this->flushHeaders()->json('delete', 'http://localhost/api/user/1');

        $response->assertStatus(200);

    }

    public function test_create(): void
    {

        $response = $this->withBearer()->json('post', 'http://localhost/api/user');

        $response->assertStatus(200);
    }

    public function test_get_all(): void
    {
        $this->getToken();

        $response = $this->withBearer()->json('get', 'http://localhost/api/user');

        $response->assertStatus(200);
    }

}
