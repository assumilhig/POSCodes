<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    public function test_confirm_password_screen_can_be_rendered()
    {
        $this->loggedInAccount();

        $this
            ->get(route('password.confirm'))
            ->assertStatus(200);
    }

    public function test_password_can_be_confirmed()
    {
        $this->loggedInAccount();

        $this
            ->post(route('password.confirm'), [
                'password' => 'password',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password()
    {
        $this->loggedInAccount();

        $this
            ->post(route('password.confirm'), [
                'password' => 'wrong-password',
            ])
            ->assertSessionHasErrors();
    }
}
