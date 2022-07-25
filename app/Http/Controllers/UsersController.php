<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
}
