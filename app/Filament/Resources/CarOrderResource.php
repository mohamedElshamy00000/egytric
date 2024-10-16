<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarOrderResource\Pages;
use App\Filament\Resources\CarOrderResource\RelationManagers;
use App\Models\CarOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Faker\Core\Number;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
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


class CarOrderResource extends Resource
{
    protected static ?string $model = CarOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'ECar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
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
                                    Select::make('electric_car_id')
                                        ->label('electric car')
                                        ->relationship('car', 'model')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Select::make('payment_method')
                                        ->label('Payment Method')
                                        ->options([
                                            'cash' => 'Cash',
                                            'visa' => 'Visa',
                                            'mastercard' => 'Mastercard',
                                        ])
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
                                    TextInput::make('amount')
                                        ->label('total amount')
                                        ->numeric()
                                        ->required(),
                                    Select::make('currency')
                                    ->label('currency')
                                        ->options([
                                            'EGP' => 'EGP',
                                            'USD' => 'USD',
                                            ])
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


                                    Forms\Components\TextInput::make('note')
                                        ->label('Note')
                                        ->placeholder('Enter note')
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                ])->columns(2),

                        ])->columnSpan(2),
                        Group::make()->schema([
                            Section::make()->schema([
                                Forms\Components\TextInput::make('shipping_method')
                                    ->label('Shipping Method')
                                    ->required()
                                    ->placeholder('Enter shipping method')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('shipping_amount')
                                    ->label('Shipping Amount')
                                    ->required()
                                    ->placeholder('Enter shipping Amount')
                                    ->maxLength(255),
                                ]),
                        ])->columnSpan(1),
                    ])
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
                Tables\Columns\TextColumn::make('car.model')
                    ->label('Car')
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
                        'cash' => 'heroicon-o-banknotes',
                        'visa' => 'heroicon-o-credit-card',
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
                Tables\Columns\TextColumn::make('amount')
                    ->label('Total Amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency')
                    ->label('currency')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('d-m-Y')
                    ->sortable(),
            ])
            ->filters([
            Tables\Filters\Filter::make('status')
                ->form([
                    Select::make('status')
                        ->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled'
                        ])
                        ->placeholder('Select Status')
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['status'],
                        fn (Builder $query, $status): Builder => $query->where('status', $status)
                    );
                }),
            Tables\Filters\Filter::make('payment_status')
                ->form([
                    Select::make('payment_status')
                        ->options([
                            'paid' => 'Paid',
                            'pending' => 'Pending',
                            'failed' => 'Failed'
                        ])
                        ->placeholder('Select Payment Status')
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query->when(
                        $data['payment_status'],
                        fn (Builder $query, $payment_status): Builder => $query->where('payment_status', $payment_status)
                    );
                }),
            Tables\Filters\Filter::make('date_range')
                ->form([
                    Forms\Components\DatePicker::make('start_date')
                        ->placeholder('Start Date'),
                    Forms\Components\DatePicker::make('end_date')
                        ->placeholder('End Date')
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['start_date'], fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date))
                        ->when($data['end_date'], fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date));
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
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
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return CarOrder::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): string
    {
        return static::getNavigationBadge() > 10 ? 'danger' : 'gray';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarOrders::route('/'),
            'create' => Pages\CreateCarOrder::route('/create'),
            'edit' => Pages\EditCarOrder::route('/{record}/edit'),
        ];
    }
}
