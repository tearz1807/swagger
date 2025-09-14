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
/*
 * ->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])*/
        $response = $this->json('delete', 'http://localhost/api/user/1');

        $response->assertStatus(200);

    }

    public function test_create(): void
    {

        $response = $this->json('post', 'http://localhost/api/user');

        $response->assertStatus(200);
    }
}
