<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\PasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['sometimes', 'required', new PasswordCheckRule()],
            'password' => ['required', 'confirmed', Password::min(8)->uncompromised()],
        ];
    }
}
