<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordCheckRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, Auth::user()->getAuthPassword());
    }

    public function message(): string
    {
        return 'Your current password is incorrect.';
    }
}
