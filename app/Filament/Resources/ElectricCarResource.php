<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ElectricCarResource\Pages;
use App\Filament\Resources\ElectricCarResource\RelationManagers;
use App\Models\ElectricCar;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\SelectAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\ImportAction;
use Filament\Actions\ExportAction;

use App\Filament\Exports\ElectricCarsExport;
use App\Filament\Imports\ElectricCarsImport;

use Filament\Pages\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ElectricCarsTemplateExport;

class ElectricCarResource extends Resource
{
    protected static ?string $model = ElectricCar::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationGroup = 'ECar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Car Details')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        Select::make('brand_id')
                                                            ->relationship('brand', 'name')
                                                            ->required(),
                                                        TextInput::make('model')
                                                            ->required()
                                                            ->live(onBlur: true)
                                                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                                                $set('slug', \Illuminate\Support\Str::slug($state));
                                                            }),
                                                        TextInput::make('slug')
                                                            ->required()
                                                            ->unique(ElectricCar::class, 'slug', ignoreRecord: true),
                                                    ]),
                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        Select::make('year')
                                                            ->options(array_combine(range(now()->year, 1900), range(now()->year, 1900)))
                                                            ->required()
                                                            ->native(false),
                                                        Select::make('condition')
                                                            ->options([
                                                                'new' => 'New',
                                                                'used' => 'Used',
                                                                'refurbished' => 'Refurbished',
                                                            ]),
                                                        Select::make('body_type')
                                                            ->options([
                                                                'sedan' => 'Sedan',
                                                                'hatchback' => 'Hatchback',
                                                                'suv' => 'SUV',
                                                                'crossover' => 'Crossover',
                                                                'pickup' => 'Pickup',
                                                                'van' => 'Van',
                                                                'wagon' => 'Wagon',
                                                                'coupe' => 'Coupe',
                                                                'convertible' => 'Convertible',
                                                            ]),
                                                    ]),
                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        TextInput::make('mileage')
                                                            ->helperText('The mileage of the car in kilometers')
                                                            ->numeric(),
                                                        Select::make('transmission')
                                                            ->options([
                                                                'automatic' => 'Automatic',
                                                            ]),
                                                        Select::make('drivetrain')
                                                            ->options([
                                                                'fwd' => 'Front-Wheel Drive',
                                                                'rwd' => 'Rear-Wheel Drive',
                                                                'awd' => 'All-Wheel Drive',
                                                                '4wd' => '4-Wheel Drive',
                                                                'aWD' => 'AWD',
                                                            ]),
                                                    ]),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Performance')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                TextInput::make('range_km')
                                                    ->helperText('The range of the car in kilometers')
                                                    ->placeholder('Enter the range in kilometers')
                                                    ->label('Range (km)')
                                                    ->numeric(),
                                                TextInput::make('battery_capacity')
                                                    ->helperText('The battery capacity of the car in kilowatt-hours')
                                                    ->placeholder('Enter the battery capacity in kWh')
                                                    ->label('Battery Capacity (kWh)')
                                                    ->numeric(),
                                                TextInput::make('horsepower')
                                                    ->placeholder('Enter the horsepower of the car')
                                                    ->helperText('The horsepower of the car in horsepower')
                                                    ->label('Horsepower (hp)')
                                                    ->numeric(),
                                                TextInput::make('acceleration')
                                                    ->helperText('The acceleration of the car from 0 to 100 kilometers per hour in seconds')
                                                    ->label('Acceleration (0-100 km/h)')
                                                    ->numeric(),
                                                TextInput::make('top_speed_kmh')
                                                    ->helperText('The top speed of the car in kilometers per hour')
                                                    ->label('Top Speed (km/h)')
                                                    ->numeric(),
                                                TextInput::make('mpge_city')
                                                    ->helperText('The city fuel economy of the car in miles per gallon equivalent')
                                                    ->label('MPGe City')
                                                    ->numeric(),
                                                TextInput::make('mpge_highway')
                                                    ->helperText('The highway fuel economy of the car in miles per gallon equivalent')
                                                    ->label('MPGe Highway')
                                                    ->numeric(),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Charging')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                TextInput::make('charging_time_ac')
                                                    ->helperText('The charging time of the car on AC in hours')
                                                    ->label('Charging Time (AC)')
                                                    ->numeric(),
                                                TextInput::make('charging_time_dc')
                                                    ->helperText('The charging time of the car on DC in hours')
                                                    ->label('Charging Time (DC)')
                                                    ->numeric(),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Home Charging Information')
                                    ->schema([
                                        TextInput::make('home_charger_type')
                                            ->helperText('The type of home charger used for the electric car, such as Level 1, Level 2, or DC fast charger')
                                            ->label('Home Charger Type')
                                            ->nullable(),
                                        TextInput::make('home_charging_power')
                                            ->label('Home Charging Power (kW)')
                                            ->helperText('The power of the home charger in kilowatts')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('home_charging_time_hours')
                                            ->label('Home Charging Time (Hours)')
                                            ->helperText('The time it takes to charge the car on AC')
                                            ->nullable()
                                            ->numeric(),
                                        Forms\Components\Checkbox::make('includes_home_charger')
                                            ->label('Includes Home Charger')
                                            ->helperText('Whether the car includes a home charger')
                                            ->default(false),
                                    ])->columns(2),
                                Forms\Components\Section::make('Battery Information')
                                    ->schema([
                                        TextInput::make('battery_type')
                                            ->label('Battery Type')
                                            ->helperText('The type of battery used in the car, such as Lithium-Ion, Lithium-Ferro-Phosphate, or Lithium-Iron-Phosphate')
                                            ->nullable(),
                                        TextInput::make('battery_modules')
                                            ->label('Battery Modules')
                                            ->helperText('The number of battery modules in the car')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('battery_cells')
                                            ->label('Battery Cells')
                                            ->helperText('The number of battery cells in the car')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('battery_voltage')
                                            ->label('Battery Voltage (V)')
                                            ->helperText('The voltage of the battery in volts')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('battery_cycles')
                                            ->label('Battery Cycles')
                                            ->helperText('The number of cycles the battery can go through before it needs to be replaced')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('battery_warranty')
                                            ->label('Battery Warranty')
                                            ->helperText('The warranty of the battery in years')
                                            ->nullable(),
                                        TextInput::make('battery_degradation_rate')
                                            ->label('Battery Degradation Rate (%)')
                                            ->helperText('The rate at which the battery degrades over time')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('battery_thermal_management')
                                            ->label('Battery Thermal Management')
                                            ->helperText('The thermal management system of the battery')
                                            ->nullable()
                                            ->numeric(),
                                    ])->columns(2),
                                Forms\Components\Section::make('Safety Features')
                                    ->schema([
                                        TextInput::make('airbag_count')
                                            ->label('Airbag Count')
                                            ->helperText('The number of airbags in the car')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('crash_test_rating')
                                            ->label('Crash Test Rating')
                                            ->helperText('The rating of the car in crash tests')
                                            ->nullable(),
                                        Forms\Components\Checkbox::make('has_pedestrian_alert')
                                            ->label('Has Pedestrian Alert')
                                            ->helperText('Whether the car has a pedestrian alert system')
                                            ->default(false),
                                        Forms\Components\Checkbox::make('has_battery_protection')
                                            ->label('Has Battery Protection')
                                            ->helperText('Whether the car has a battery protection system')
                                            ->default(false),
                                        Forms\Components\Checkbox::make('has_lane_departure')
                                            ->label('Has Lane Departure')
                                            ->helperText('Whether the car has a lane departure system')
                                            ->default(false),
                                        Forms\Components\Checkbox::make('has_blind_spot')
                                            ->label('Has Blind Spot Detection')
                                            ->helperText('Whether the car has a blind spot detection system')
                                            ->default(false),
                                        Forms\Components\Checkbox::make('has_emergency_brake')
                                            ->label('Has Emergency Brake')
                                            ->helperText('Whether the car has an emergency brake system')
                                            ->default(false),
                                    ])->columns(2),
                                Forms\Components\Section::make('Dimensions and Weight')
                                    ->schema([
                                        Forms\Components\Checkbox::make('has_fast_charging')
                                            ->label('Has Fast Charging')
                                            ->helperText('Whether the car has a fast charging system')
                                            ->default(false)
                                            ->columnSpanFull(),
                                        TextInput::make('length_mm')
                                            ->label('Length (mm)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('width_mm')
                                            ->label('Width (mm)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('wheelbase_mm')
                                            ->label('Wheelbase (mm)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('ground_clearance_mm')
                                            ->label('Ground Clearance (mm)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('cargo_volume_l')
                                            ->label('Cargo Volume (L)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('curb_weight_kg')
                                            ->label('Curb Weight (kg)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('gross_weight_kg')
                                            ->label('Gross Weight (kg)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('payload_capacity_kg')
                                            ->label('Payload Capacity (kg)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('seating_capacity')
                                            ->label('Seating Capacity')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('power_consumption_kwh_100km')
                                            ->label('Power Consumption (kWh/100km)')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('regenerative_levels')
                                            ->label('Regenerative Levels')
                                            ->nullable()
                                            ->numeric(),
                                        TextInput::make('max_regenerative_power')
                                            ->label('Max Regenerative Power')
                                            ->nullable()
                                            ->numeric(),
                                        Forms\Components\Textarea::make('charging_ports')
                                            ->label('Charging Ports')
                                            ->columnSpanFull()
                                            ->nullable(),
                                    ])->columns(2),
                                Forms\Components\Section::make('Additional Details')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->label('Description')
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(2),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Pricing')
                                    ->schema([
                                        TextInput::make('msrp')
                                            ->required()
                                            ->label('MSRP')
                                            ->prefix('EGP')
                                            ->helperText('The original price of the car before any discounts')
                                            ->numeric(),
                                        TextInput::make('offer_price')
                                            ->required()
                                            ->label('Offer Price')
                                            ->prefix('EGP')
                                            ->helperText('The price after any discounts')
                                            ->numeric(),

                                        Forms\Components\Checkbox::make('is_available')
                                            ->label('Is Available')
                                            ->helperText('Whether the car is available for sale')
                                            ->default(true),
                                    ])->columns(2),
                                Forms\Components\Section::make('Colors')
                                ->schema([
                                    ColorPicker::make('exterior_color')
                                        ->label('Exterior Color')
                                        ->required(),
                                    ColorPicker::make('interior_color')
                                        ->label('Interior Color')
                                        ->required(),
                                ])->columns(2),
                                Forms\Components\Section::make('Features')
                                    ->schema([
                                        Forms\Components\TagsInput::make('features'),
                                    ]),

                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\Repeater::make('images')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\FileUpload::make('image_path')
                                                ->image()
                                                ->directory('electric-car-images')
                                                ->required(),
                                        ])
                                        ->columns(1)
                                        ->columnSpanFull(),
                                    ])

                            ])
                            ->columnSpan(1),
                    ])
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(ElectricCarsImport::class)
                    ->chunkSize(100)
                    ->label('Import Cars')
                    ->options([
                        'update_existing' => true,
                        'identify_by' => ['model', 'year'],
                    ]),
                Tables\Actions\Action::make('export_template')
                    ->label('Export Empty Template')
                    ->action(function () {
                        return Excel::download(new ElectricCarsTemplateExport, 'electric-cars-template.xlsx');
                    }),
            ])
            ->columns([
                ImageColumn::make('images.0.image_path')
                    ->label('Image')
                    ->circular(),
                TextColumn::make('brand.name')
                    ->label('Brand')
                    ->toggleable(),
                IconColumn::make('is_available')
                    ->label('Is Available')
                    ->boolean(),
                TextColumn::make('model')
                    ->label('Model'),
                TextColumn::make('year')
                    ->label('Year'),
                TextColumn::make('condition')
                    ->label('Condition'),
                TextColumn::make('body_type')
                    ->label('Body Type'),
                TextColumn::make('mileage')
                    ->label('Mileage'),
                TextColumn::make('transmission')
                    ->label('Transmission'),
                TextColumn::make('drivetrain')
                    ->label('Drivetrain'),
                ColorColumn::make('exterior_color')
                    ->label('Exterior Color'),
                ColorColumn::make('interior_color')
                    ->label('Interior Color'),
                TextColumn::make('msrp')
                    ->label('MSRP')
                    ->money('EGP'),
                TextColumn::make('offer_price')
                    ->label('Offer Price')
                    ->money('EGP'),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListElectricCars::route('/'),
            'create' => Pages\CreateElectricCar::route('/create'),
            'edit' => Pages\EditElectricCar::route('/{record}/edit'),
        ];
    }
}
