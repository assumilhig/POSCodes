<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_login_screen_can_be_rendered()
    {
        $this
            ->get(route('login'))
            ->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = $this->createAccount();

        $this
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }

    public function test_users_can_authenticate_and_last_login_at_must_be_updated()
    {
        $user = $this->createAccount();

        $this
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();
        $this->assertNotEquals(User::first()->last_login_at, null);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = $this->createAccount();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_not_authenticate_with_inactive_account()
    {
        $user = $this->createAccount(['inactive' => true]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
    }
}
