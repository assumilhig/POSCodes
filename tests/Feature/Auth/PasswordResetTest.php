<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    public function test_reset_password_link_screen_can_be_rendered()
    {
        $this
            ->get(route('password.request'))
            ->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = $this->createAccount();

        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $user = $this->createAccount();

        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $this
                ->get(route('password.reset', ['token' => $notification->token]))
                ->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = $this->createAccount();

        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this
                ->post(route('password.update'), [
                    'token' => $notification->token,
                    'email' => $user->email,
                    'password' => 'new-password',
                    'password_confirmation' => 'new-password',
                ])
                ->assertSessionHasNoErrors();

            return true;
        });
    }

    public function test_ensure_new_password_must_be_correct()
    {
        Notification::fake();

        $user = $this->createAccount();

        $this->post(route('password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this
                ->post(route('password.update'), [
                    'token' => $notification->token,
                    'email' => $user->email,
                    'password' => $newPassword = 'new-password',
                    'password_confirmation' => $newPassword,
                ])
                ->assertSessionHasNoErrors();

            Hash::check($newPassword, User::first()->password);

            return true;
        });
    }
}
