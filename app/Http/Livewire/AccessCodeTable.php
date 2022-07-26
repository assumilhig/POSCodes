<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Enum\AccessCodeStatusEnum;
use App\Models\AccessCode;
use App\Models\AccessType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AccessCodeTable extends DataTable
{
    protected bool $eagerLoadAllRelationsStatus = true;

    protected array $relations = ['issuedBy', 'type'];

    protected $model = AccessCode::class;

    public function columns(): array
    {
        return [
            Column::make('Type', 'type.description')
                ->searchable()
                ->eagerLoadRelations(),
            Column::make('Codes', 'codes')->sortable()->searchable(),
            Column::make('Status', 'status')
                ->searchable()
                ->collapseOnTablet()
                ->format(function ($value) {
                    return match ($value) {
                        AccessCodeStatusEnum::ISSUED => '<span class="badge badge-danger">Issued</span>',
                        AccessCodeStatusEnum::USED => '<span class="badge badge-warning">Used</span>',
                        AccessCodeStatusEnum::EXPIRED => '<span class="badge badge-secondary">Expired</span>',
                        default => '<span class="badge badge-success">Available</span>',
                    };
                })
                ->html(),
            Column::make('Store', 'store_code')->collapseOnTablet(),
            Column::make('Sales Invoice', 'transaction_number')->collapseOnTablet(),
            Column::make('Issued By')
                ->format(fn ($value, $row, Column $column) => $row->issuedBy->name)
                ->eagerLoadRelations()
                ->collapseOnTablet(),
            Column::make('Date Created', 'created_at')->sortable()->collapseOnTablet(),
            Column::make('Last Updated', 'updated_at')->sortable()->collapseOnTablet(),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Access Type')
                ->options(
                    AccessType::query()->orderBy('description')->get()->keyBy('id')->map(fn ($tag) => $tag->description)->toArray()
                )->filter(function (Builder $builder, array $values) {
                    return $builder->whereHas('type', fn ($query) => $query->whereIn('access_types.id', $values));
                }),
            SelectFilter::make('Status')
                ->options(collect(AccessCodeStatusEnum::cases())->pluck('name', 'value')->toArray())
                ->filter(function (Builder $builder, string $value) {
                    return match ($value) {
                        '0' => $builder->where('status', AccessCodeStatusEnum::AVAILABLE),
                        '1' => $builder->where('status', AccessCodeStatusEnum::ISSUED),
                        '2' => $builder->where('status', AccessCodeStatusEnum::USED),
                        '3' => $builder->where('status', AccessCodeStatusEnum::EXPIRED),
                    };
                }),

        ];
    }

    public function builder(): Builder
    {
        return $this->getModel()::query()->orderByDesc('access_type_id')->orderBy('status');
    }
}
