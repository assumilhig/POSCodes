<?php

declare(strict_types=1);

namespace App\Services;

class Services
{
    protected $repository;

    public function create($data)
    {
        $result = $this->repository->create($data);

        return $result;
    }
}
