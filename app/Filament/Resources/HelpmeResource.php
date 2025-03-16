<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HelpmeResource\Pages;
use App\Filament\Resources\HelpmeResource\RelationManagers;
use App\Models\Helpme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HelpmeResource extends Resource
{
    protected static ?string $model = Helpme::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'ECar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Helpme')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Personal Information')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')->required()->columnSpan(1),
                                        Forms\Components\TextInput::make('email')->email()->required()->columnSpan(1),
                                        Forms\Components\TextInput::make('phone')->required()->columnSpan(1),
                                        Forms\Components\TextInput::make('city')->required()->columnSpan(1),
                                        Forms\Components\TextInput::make('area')->label('state')->required()->columnSpan(1),
                                    ])
                                    ->columns([
                                        'default' => 1,
                                        'sm' => 2,
                                        'lg' => 2,
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Car Preferences')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('use_car_to_travel')->columnSpan(1),
                                        Forms\Components\TextInput::make('property_type')->required()->columnSpan(1),
                                        Forms\Components\Select::make('brands')
                                            ->relationship('brands', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('price_range')
                                            ->numeric()
                                            ->prefix('EGP')
                                            ->required()
                                            ->columnSpan(1),
                                    ])
                                    ->columns([
                                        'default' => 1,
                                        'sm' => 2,
                                        'lg' => 2,
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Quote Request')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_quote_request')
                                            ->label('Is Quote Request?')
                                            ->columnSpan(1),
                                        Forms\Components\Select::make('car_id')
                                            ->relationship('car', 'model')
                                            ->searchable()
                                            ->preload()
                                            ->visible(fn ($get) => $get('is_quote_request'))
                                            ->columnSpan(2),
                                        Forms\Components\DateTimePicker::make('quote_requested_at')
                                            ->visible(fn ($get) => $get('is_quote_request'))
                                            ->columnSpan(1),
                                    ])
                                    ->columns([
                                        'default' => 1,
                                        'sm' => 2,
                                        'lg' => 2,
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Additional Information')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->options([
                                                'pending' => 'Pending',
                                                'in_progress' => 'In Progress',
                                                'completed' => 'Completed',
                                                'cancelled' => 'Cancelled',
                                            ])
                                            ->required()
                                            ->columnSpan(1),
                                        Forms\Components\Textarea::make('comment')
                                            ->rows(4)
                                            ->required()
                                            ->columnSpan(2),
                                    ])
                                    ->columns([
                                        'default' => 1
                                    ]),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('city')
                    ->searchable(),

                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'pending' => 'pending',
                        'in_progress' => 'in progress',
                        'completed' => 'completed',
                        'cancelled' => 'cancelled',
                    ])
                    ->sortable()
                    ->afterStateUpdated(function($record, $state) {
                        Notification::make()
                            ->title('Status Updated')
                            ->body("updated to {$state}")
                            ->success()
                            ->send();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('created at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_quote_request')
                    ->boolean()
                    ->label('Quote'),
                Tables\Columns\TextColumn::make('car.model')
                    ->label('Requested Car')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('status')
                    ->options([
                        'pending' => 'pending',
                        'in_progress' => 'in progress',
                        'completed' => 'completed',
                        'cancelled' => 'cancelled',
                    ]),
                Tables\Filters\TernaryFilter::make('is_quote_request')
                    ->label('Quote Requests')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_quote_request', true),
                        false: fn (Builder $query) => $query->where('is_quote_request', false),
                        blank: fn (Builder $query) => $query
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
        return Helpme::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): string
    {
        return static::getNavigationBadge() > 10 ? 'danger' : 'gray';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHelpmes::route('/'),
            'create' => Pages\CreateHelpme::route('/create'),
            'edit' => Pages\EditHelpme::route('/{record}/edit'),
        ];
    }
}
