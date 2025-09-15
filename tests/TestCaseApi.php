<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RonasIT\AutoDoc\Traits\AutoDocTestCaseTrait;

abstract class TestCaseApi extends BaseTestCase
{
    use AutoDocTestCaseTrait;


    static $seed = false;
    protected $token = '';

    /**
     * Setup the data test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        if (!self::$seed) {
            self::$seed = true;
            $this->artisan('migrate:fresh');
            $this->seed();
        }
        $this->getToken();
    }

    protected function getToken()
    {
        $response = $this->json('post', 'http://localhost/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
        $this->token = (json_decode($response->getContent()))->access_token;
        return $this->token;
    }

    protected function withBearer()
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ]);
    }
}
