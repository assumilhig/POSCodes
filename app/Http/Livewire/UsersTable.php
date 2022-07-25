<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTable
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Last Name', 'last_name')
                ->sortable(),
            Column::make('First Name', 'first_name')
                ->sortable(),
            Column::make('Email Address', 'email')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Status', 'inactive')
                ->sortable()
                ->format(function ($value) {
                    if (! $value) {
                        return '<span class="badge badge-success">Active</span>';
                    }

                    return '<span class="badge badge-danger">Inactive</span>';
                })
                ->html()
                ->collapseOnTablet(),
            Column::make('Date Approved', 'approve_at')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Date Created', 'created_at')
                ->sortable()
                ->collapseOnTablet(),
        ];
    }
}
