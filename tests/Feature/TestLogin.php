<?php

namespace Tests\Feature;

use Tests\TestCase;

class TestLogin extends TestCase
{
    /**
     * A basic test example.
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|void
     */
    public function login()
    {

        $this->json('POST', '/api/1.0/token', ['cellphone' => '09124251131']);
        $token = $this->json('POST', '/api/1.0/login', ['cellphone' => '09124251131', 'password' => '1111']);

        $token->assertStatus(200);

        return $token;
    }


}
