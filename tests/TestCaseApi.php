<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RonasIT\AutoDoc\Traits\AutoDocTestCaseTrait;

abstract class TestCaseApi extends BaseTestCase
{
    use AutoDocTestCaseTrait;


    static $seed = false;

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
            $this->artisan('migrate:refresh');
            $this->seed();
        }
    }

    protected function setToken()
    {
        $this->json('post', 'http://localhost/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
        return $this;
    }

}
