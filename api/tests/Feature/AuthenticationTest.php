<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginAuthentication()
    {
        $data = [
            'email' => 'test@minisender.com',
            'password' => 'password'
        ];
        $response = $this->post('/api/login',$data);

        $response->assertStatus(200)->assertJsonStructure(['access_token','token_type']);
    }
}
