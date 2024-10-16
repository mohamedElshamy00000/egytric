<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;
use Filament\Tables\Actions\Action as TableAction;


class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'Delivered' => 'success',
                        'cancelled' => 'danger',
                    })->icon(fn (string $state): string => match ($state) {
                        'new' => 'heroicon-o-inbox-stack',
                        'processing' => 'heroicon-o-clock',
                        'shipped' => 'heroicon-o-truck',
                        'Delivered' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                    }),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cash' => 'info',
                        'visa' => 'success',
                        'mastercard' => 'danger',
                    })->icon(fn (string $state): string => match ($state) {
                        'cash' => 'heroicon-o-banknotes',
                        'visa' => 'heroicon-o-credit-card',
                        'mastercard' => 'heroicon-o-currency-dollar',
                    }),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('grand_total')
                    ->money('EGP'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y'),
            ])
            ->actions([
                TableAction::make('view Order')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('primary')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
