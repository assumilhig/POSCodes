<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Concerns\SendsAlerts;
use App\Repositories\Interface\RepositoryInterface;

class Repository implements RepositoryInterface
{
    use SendsAlerts;

    protected $model;

    public function create($data)
    {
        $result = $this->model->create($data);

        return $result;
    }
}
