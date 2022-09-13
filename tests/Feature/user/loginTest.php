<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class loginTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function ユーザーがログインできる()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $this->get('/')->assertSee($this->user->last_name);
        $this->assertAuthenticatedAs($this->user);
    }

    /** @test */
    public function ユーザーがログアウトできる()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticatedAs($this->user);
        $response = $this->post('/logout');
        $response = $this->get('/')->assertSee('ログイン');
    }
}