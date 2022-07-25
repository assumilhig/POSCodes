<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\AccessCode;
use App\Models\AccessType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AccessCodeTable extends DataTable
{
    protected $model = AccessCode::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Type', 'type.description')
                ->sortable()
                ->searchable()
                ->eagerLoadRelations(), // Adds with('address') to the query
            Column::make('Codes', 'codes')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->format(function ($value) {
                    switch ($value) {
                        case AccessCode::ISSUED:
                            return '<span class="badge badge-danger">Issued</span>';
                            break;
                        case AccessCode::USED:
                            return '<span class="badge badge-warning">Used</span>';
                            break;

                        case AccessCode::EXPIRED:
                            return '<span class="badge badge-secondary">Expired</span>';
                            break;

                        default:
                            return '<span class="badge badge-success">Available</span>';
                            break;
                    }
                })
                ->html(),
            Column::make('Store', 'store_code')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Sales Invoice', 'transaction_number')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Issued By')
                ->format(fn ($value, $row, Column $column) => $row->issuedBy->name)
                ->sortable()
                ->eagerLoadRelations()
                ->collapseOnTablet(),
            Column::make('Date Created', 'created_at')
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Last Updated', 'updated_at')
                ->sortable()
                ->collapseOnTablet(),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Access Type')
                ->options(
                    AccessType::query()
                        ->orderBy('description')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($tag) => $tag->description)
                        ->toArray()
                )->filter(function (Builder $builder, array $values) {
                    $builder->whereHas('type', fn ($query) => $query->whereIn('access_types.id', $values));
                }),
            SelectFilter::make('Status')
                ->setFilterPillTitle('Code Status')
                ->options([
                    '' => 'All',
                    '0' => 'Available',
                    '1' => 'Issued',
                    '2' => 'Used',
                    '3' => 'Expired',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '0') {
                        $builder->where('status', AccessCode::AVAILABLE);
                    } elseif ($value === '1') {
                        $builder->where('status', AccessCode::ISSUED);
                    } elseif ($value === '2') {
                        $builder->where('status', AccessCode::USED);
                    } elseif ($value === '3') {
                        $builder->where('status', AccessCode::EXPIRED);
                    }
                }),

        ];
    }

    public function builder(): Builder
    {
        return $this->model::query()
            ->orderByDesc('access_type_id')
            ->orderBy('status');
    }
}
