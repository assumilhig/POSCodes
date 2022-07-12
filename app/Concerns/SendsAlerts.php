<?php

declare(strict_types=1);

namespace App\Concerns;

trait SendsAlerts
{
    protected function success(string $parameters)
    {
        $this->sendAlert('success', $parameters);
    }

    protected function error(string $parameters)
    {
        $this->sendAlert('error', $parameters);
    }

    private function sendAlert(string $type, string $parameters)
    {
        request()->session()->flash($type, $parameters);
    }
}
