<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserRepository extends Repository
{
    protected $model;

    public function __construct()
    {
        return $this->model = new User;
    }

    public function create($data)
    {
        $result = $this->model->create($data);

        event(new Registered($result));

        return $result;
    }

    public function update($data)
    {
        $result = $this->model->where(Auth::user()->getAuthIdentifierName(), Auth::user()->getAuthIdentifier())->update($data);

        return $result;
    }
}
