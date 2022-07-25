<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

class DataTable extends DataTableComponent
{
    public bool $dumpFilters = false;

    public array $perPageAccepted = [25, 50, 100, 200];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [];
    }
}
