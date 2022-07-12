<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\UserService;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        return view('profile.index');
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->userService->update($request->validated());

        $this->success(__('messages.success', ['title' => 'personal information']));

        return redirect()->route('profile.index');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        $this->userService->update($request->only('password'));

        $this->success(__('messages.success', ['title' => 'password']));

        return redirect()->route('profile.index');
    }
}
