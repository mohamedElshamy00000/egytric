<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('New Orders', Order::where('status', 'new')->count())
                ->chart([
                    Order::where('status', 'new')->whereDate('created_at', '>', now()->subDays(7))->count(),
                    Order::where('status', 'new')->whereDate('created_at', '>', now()->subDays(14))->count(),
                    Order::where('status', 'new')->whereDate('created_at', '>', now()->subDays(21))->count(),
                ])
                ->description('Last 7, 14, 21 days')
                ->color('success'),
            Stat::make('Processing Orders', Order::where('status', 'processing')->count())
                ->chart([
                    Order::where('status', 'processing')->whereDate('updated_at', '>', now()->subDays(7))->count(),
                    Order::where('status', 'processing')->whereDate('updated_at', '>', now()->subDays(14))->count(),
                    Order::where('status', 'processing')->whereDate('updated_at', '>', now()->subDays(21))->count(),
                ])
                ->description('Last 7, 14, 21 days')
                ->color('warning'),
            Stat::make('Shipped Orders', Order::where('status', 'shipped')->count())
                ->chart([
                    Order::where('status', 'shipped')->whereDate('updated_at', '>', now()->subDays(7))->count(),
                    Order::where('status', 'shipped')->whereDate('updated_at', '>', now()->subDays(14))->count(),
                    Order::where('status', 'shipped')->whereDate('updated_at', '>', now()->subDays(21))->count(),
                ])
                ->description('Last 7, 14, 21 days')
                ->color('info'),

            Stat::make('Average Order Value', 'EGP ' . number_format(Order::avg('grand_total'), 2))
                ->description('Last 30 days: EGP ' . number_format(Order::where('created_at', '>', now()->subDays(30))->avg('grand_total'), 2))
                ->chart([
                    Order::where('created_at', '>', now()->subDays(7))->avg('grand_total'),
                    Order::where('created_at', '>', now()->subDays(14))->avg('grand_total'),
                    Order::where('created_at', '>', now()->subDays(21))->avg('grand_total'),
                    Order::where('created_at', '>', now()->subDays(28))->avg('grand_total'),
                ])
                ->color('purple'),
            Stat::make('Total Order Value', 'EGP ' . number_format(Order::sum('grand_total'), 2))
                ->description('Total value of all orders')
                ->chart([
                    Order::where('created_at', '>', now()->subDays(7))->sum('grand_total'),
                    Order::where('created_at', '>', now()->subDays(14))->sum('grand_total'),
                    Order::where('created_at', '>', now()->subDays(21))->sum('grand_total'),
                    Order::where('created_at', '>', now()->subDays(28))->sum('grand_total'),
                ])
                ->color('green'),

            Stat::make('Car Orders', \App\Models\CarOrder::count())
                ->chart([
                    \App\Models\CarOrder::whereDate('created_at', '>', now()->subDays(7))->count(),
                    \App\Models\CarOrder::whereDate('created_at', '>', now()->subDays(14))->count(),
                    \App\Models\CarOrder::whereDate('created_at', '>', now()->subDays(21))->count(),
                    \App\Models\CarOrder::whereDate('created_at', '>', now()->subDays(28))->count(),
                ])
                ->description('Last 7, 14, 21, 28 days')
                ->color('blue'),


        ];
    }
}
