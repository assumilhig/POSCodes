<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends Services
{
    protected $repository;

    public function __construct()
    {
        return $this->repository = new UserRepository;
    }

    public function update($data)
    {
        return $this->repository->update($data);
    }
}
