<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Faker\Core\Number;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Support\Number as SupportNumber;

use function Laravel\Prompts\select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Store';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')
                        ->schema([
                            Select::make('user_id')
                                ->label('customer')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('payment_method')
                                ->label('Payment Method')
                                ->options([
                                    'cashOnDelivery' => 'Cash On Delivery',
                                    'creditCard' => 'Credit Card',
                                    'mastercard' => 'Mastercard',
                                ])
                                ->required(),
                            TextInput::make('currency')
                                ->hidden()
                                ->default('EGP')
                                ->required(),
                            Select::make('payment_status')
                                ->label('Payment Status')
                                ->options([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'failed' => 'Failed',
                                ])
                                ->default('Pending')
                                ->required(),

                            ToggleButtons::make('status')
                                ->label('Status')
                                ->inline()
                                ->default('new')
                                ->options([
                                    'new' => 'new',
                                    'processing' => 'Processing',
                                    'shipped' => 'Shipped',
                                    'delivered' => 'Delivered',
                                    'canceled' => 'Canceled',
                                ])
                                ->colors([
                                    'new' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'success',
                                    'delivered' => 'success',
                                    'canceled' => 'danger',
                                ])->icons([
                                    'new' => 'heroicon-m-sparkles',
                                    'processing' => 'heroicon-m-arrow-path',
                                    'shipped' => 'heroicon-m-truck',
                                    'delivered' => 'heroicon-m-check-badge',
                                    'canceled' => 'heroicon-m-x-circle',
                                ]),

                            Forms\Components\TextInput::make('shipping_method')
                                ->label('Shipping Method')
                                ->required()
                                ->placeholder('Enter shipping method')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('note')
                                ->label('Note')
                                ->placeholder('Enter note')
                                ->maxLength(255),

                        ])->columns(2),

                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)->price ?? 0))
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)->price ?? 0))
                                    ->columnSpan(4),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->required()
                                    ->default(1)
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(100)
                                    ->step(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount', $get('unit_amount') * $state))
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('unit_amount')
                                    ->label('Unit Amount')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                Forms\Components\TextInput::make('total_amount')
                                    ->label('Total Amount')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->dehydrated()
                                    ->step(0.01)
                                    ->columnSpan(3),

                            ])->columns(12),

                            Placeholder::make('subtotal')
                                ->label('Subtotal')
                                ->content(function (Get $get, Set $set) {
                                    $subtotal = 0;
                                    $repeaters = $get('items');

                                    if (empty($repeaters)) {
                                        return $subtotal;
                                    }

                                    foreach ($repeaters as $key => $repeater) {
                                        $totalAmount = $get("items.{$key}.total_amount");
                                        if (is_numeric($totalAmount)) {
                                            $subtotal += $totalAmount;
                                        }
                                    }
                                    $set('grand_total', $subtotal);
                                    return number_format($subtotal, 2) . ' EGP';
                                }),

                            Hidden::make('grand_total')
                                ->default(0)
                    ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'cancelled' => 'Cancelled'
                    ])
                    ->sortable()
                    ->afterStateUpdated(function($record, $state) {

                        Notification::make()
                            ->title('Status Updated')
                            ->body("Order status has been updated to {$state}")
                            ->success()
                            ->send();
                    }),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->sortable()
                    ->icon(fn (string $state): string => match ($state) {
                        'cashOnDelivery' => 'heroicon-o-banknotes',
                        'creditCard' => 'heroicon-o-credit-card',
                        'mastercard' => 'heroicon-o-currency-dollar',
                        default => 'heroicon-o-question-mark-circle',
                    }),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Total Amount')
                    ->money('EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Customer')
                    ->placeholder('All Customers')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'cancelled' => 'Cancelled'
                    ])
                    ->label('Status')
                    ->placeholder('All Statuses'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('to')
                            ->label('To Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'From: ' . $data['from'];
                        }
                        if ($data['to'] ?? null) {
                            $indicators['to'] = 'To: ' . $data['to'];
                        }
                        return $indicators;
                    }),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Order::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): string
    {
        return static::getNavigationBadge() > 10 ? 'danger' : 'gray';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
