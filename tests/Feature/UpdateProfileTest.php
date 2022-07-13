<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    public function test_profile_screen_can_be_rendered()
    {
        $this->loggedInAccount();

        $response = $this->get(route('profile.index'));

        $response->assertStatus(200);
    }

    public function test_user_can_update_personal_information()
    {
        $this->loggedInAccount([
            'last_name' => 'User',
            'first_name' => 'Test',
            'email' => 'mail@mail.com',
        ]);

        $this
            ->post(route('profile.update'), [
                'last_name' => 'User',
                'first_name' => 'Test2',
                'email' => 'mail2@mail.com',
            ])
            ->assertSessionHas('success')
            ->assertRedirect(route('profile.index'));

        $user = User::query()->where('email', 'mail2@mail.com')->first();

        $this->assertEquals('Test2', $user->first_name);
    }

    public function test_user_can_change_password()
    {
        $this->loggedInAccount();

        $this
            ->post(route('profile.change_password'), [
                'current_password' => 'password',
                'password' => 'someP@ssword',
                'password_confirmation' => 'someP@ssword',
            ])
            ->assertSessionHas('success')
            ->assertRedirect(route('profile.index'));

        Hash::check('someP@ssword', User::first()->password);
    }
}
