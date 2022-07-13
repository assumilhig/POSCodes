<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\AccessCodeRepository;

class AccessCodeService extends Services
{
    protected $repository;

    public function __construct()
    {
        return $this->repository = new AccessCodeRepository;
    }

    public function createAccessCodeWithType($data)
    {
        return $this->repository->createAccessCodeWithType($data);
    }
}
