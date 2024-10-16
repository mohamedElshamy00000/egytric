<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->color('dark')->icon('heroicon-m-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Orders'),
            'new' => Tab::make('new Orders')->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'new')),
            'processing' => Tab::make('processing Orders')->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('shipped Orders')->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'shipped')),
            'Delivered' => Tab::make('Delivered Orders')->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Delivered')),
            'cancelled' => Tab::make('cancelled Orders')->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled')),
        ];
    }
}
