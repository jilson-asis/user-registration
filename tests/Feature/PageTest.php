<?php

namespace Tests\Feature;

use App\Models\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLoginAndRegisterPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /*
     * Tests that requires auth
     */

    public function testAuthPages()
    {
        $user = User::first();

        $response = $this->actingAs($user)
            ->get('/home');
        $response->assertStatus(200);

        $response = $this->actingAs($user)
            ->get('/message/compose');
        $response->assertStatus(200);

        $response = $this->actingAs($user)
            ->get('/message/messages');
        $response->assertStatus(200);

        $thread_id = Message::first()->thread_id;

        $response = $this->actingAs($user)
            ->get('/message/view?tid=' . $thread_id);
        $response->assertStatus(200);
    }
}
