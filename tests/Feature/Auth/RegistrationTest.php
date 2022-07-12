<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_can_be_rendered()
    {
        $this
            ->get(route('register'))
            ->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $this
            ->post(route('register'), [
                'last_name' => 'User',
                'first_name' => 'Test',
                'email' => 'test@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }

    public function test_users_cannot_register_with_existing_email()
    {
        $user = $this->createAccount();

        $this
            ->post(route('register'), [
                'last_name' => 'User',
                'first_name' => 'Test',
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_password_must_be_confirmed()
    {
        $this
            ->post(route('register'), [
                'last_name' => 'User',
                'first_name' => 'Test',
                'email' => 'user@example.com',
                'password' => 'password',
            ])
            ->assertSessionHasErrors('password', 'The password confirmation does not match.');

        $this->assertGuest();
    }

    public function test_password_must_be_bcrypt_data()
    {
        $this
            ->post(route('register'), [
                'last_name' => 'User',
                'first_name' => 'Test',
                'email' => 'user@example.com',
                'password' => $password = 'password',
                'password_confirmation' => $password,
            ]);

        $this->assertTrue(Hash::check('password', User::first()->password));
    }
}
