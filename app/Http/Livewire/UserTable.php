<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Last name', 'last_name')
                ->sortable(),
            Column::make('First name', 'first_name')
                ->sortable(),
            Column::make('Email', 'email')
                ->sortable(),
            Column::make('Inactive', 'inactive')
                ->sortable(),
            Column::make('Last login ip', 'last_login_ip')
                ->sortable(),
            Column::make('Last login at', 'last_login_at')
                ->sortable(),
            Column::make('Approve at', 'approve_at')
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->sortable(),
        ];
    }
}
