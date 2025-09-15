<?php

namespace Tests\Feature;


use Tests\TestCaseApi;

class UserLoginTest extends TestCaseApi
{


    /**
     * Test user login.
     *
     * @return void
     */

    public function test_login(): void
    {

        $response = $this->json('post', 'http://localhost/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test login.
     *
     * @return void
     */

    public function test_login_unprocessable(): void
    {

        $response = $this->json('post', 'http://localhost/api/auth/login');

        $response->assertStatus(422);
    }

    /**
     * Test login.
     *
     * @return void
     */

    public function test_login_unauthorized(): void
    {

        $response = $this->json('post', 'http://localhost/api/auth/login',[
            'email' => 'test@fail.ru',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
    }

}
