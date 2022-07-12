<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    protected function createAccount($userAttributes = [])
    {
        return User::factory()->create($userAttributes);
    }

    protected function loggedInAccount($userAttributes = [])
    {
        $user = $this->createAccount($userAttributes);
        $this->actingAs($user);

        return $user;
    }

    protected function loggedInUnverified($userAttributes = ['email_verified_at' => null])
    {
        $user = $this->createAccount($userAttributes);
        $this->actingAs($user);

        return $user;
    }
}
