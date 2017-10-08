<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    public function testRegistrationAndLoginFlow()
    {
        $response = $this->post('/register', [
            'username' => 'unit.tester',
            'name' => 'mr. unit tester',
            'email' => 'unit@tester.com',
            'password' => 'unit tester',
            'password_confirmation' => 'unit tester',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue($response->getStatusCode() !== 500);

        $response = $this->post('/login', [
            'email' => 'unit@tester.com',
            'password' => 'unit tester',
        ]);

        $response->assertRedirect('/home');
        $this->assertTrue($response->getStatusCode() !== 500);
    }
}
