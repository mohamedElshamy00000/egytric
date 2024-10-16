<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChargingStationResource\Pages;
use App\Filament\Resources\ChargingStationResource\RelationManagers;
use App\Models\ChargingStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Dotswan\MapPicker\Fields\Map;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
class ChargingStationResource extends Resource
{
    protected static ?string $model = ChargingStation::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Charging Stations';

    protected static ?string $navigationGroup = 'Global';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('name'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('address'),
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\TextInput::make('kw')
                    ->label('KW')
                    ->nullable(),
                TextInput::make('latitude')
                    ->required(),

                TextInput::make('longitude')
                    ->required(),

                Map::make('location')
                    ->label('Location')
                    ->columnSpanFull()
                    ->defaultLocation(latitude: 26.8206, longitude: 30.8025)
                    ->afterStateHydrated(function ($state, $record, callable $set): void {
                        $set('location', ['lat' => $record?->latitude, 'lng' => $record?->longitude]);
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    })
                    ->extraStyles([
                        'min-height: 50vh',
                        'border-radius: 7px'
                    ])
                    ->liveLocation(true, true, 5000)
                    ->showMarker()
                    ->markerColor("#000000")
                    ->showFullscreenControl()
                    ->showZoomControl()
                    ->draggable()
                    ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png/")
                    ->zoom(6)
                    ->detectRetina()
                    ->extraTileControl([])
                    ->extraControl([
                        'zoomDelta'           => 1,
                        'zoomSnap'            => 2,

                    ]),

                Forms\Components\Toggle::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->inline(false)
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('name')->searchable(),
                Tables\Columns\TextColumn::make('address')->label('address')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('description')->searchable(),
                Tables\Columns\TextColumn::make('kw')->label('KW')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('updated_at')->dateTime(),

            ])
            ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'available' => 'Available',
                    'occupied' => 'Occupied',
                ]),
            Tables\Filters\Filter::make('created_at')
                ->label('Created At')
                ->form([
                    Forms\Components\DatePicker::make('created_from')->label('From'),
                    Forms\Components\DatePicker::make('created_until')->label('Until'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['created_from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                        ->when($data['created_until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                }),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChargingStations::route('/'),
            'create' => Pages\CreateChargingStation::route('/create'),
            'edit' => Pages\EditChargingStation::route('/{record}/edit'),
        ];
    }
}
