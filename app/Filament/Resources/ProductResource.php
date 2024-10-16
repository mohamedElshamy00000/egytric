<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Set;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Store';
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        TextInput::make('name')
                                ->maxLength(255)
                                ->required()
                                ->live(onBlur:true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->unique(Product::class, 'slug', ignoreRecord:true)
                            ->required(),
                        MarkdownEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(2),
                    Section::make('Images')->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->reorderable()
                            ->directory('products')
                            ->nullable(),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('EGP'),
                        Toggle::make('is_stock')
                            ->required()
                            ->helperText('Select this option to display the product in the main products list.')
                            ->default(true),
                        Toggle::make('is_active')
                            ->required()
                            ->helperText('Select this option to display the product in the main products list.')
                            ->default(true),
                        Toggle::make('is_featured')
                            ->required()
                            ->helperText('Select this option to display the product in the Featured Products section.')
                            ->default(false),
                        Toggle::make('on_sale')
                            ->required()
                            ->helperText('Select this option to display the product in the Sale section.')
                            ->default(false),
                    ]),
                    Section::make('Association')->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->circular()
                    ->stacked()
                    ->limit(3),
                Tables\Columns\TextColumn::make('name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_stock')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('on_sale')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Category'),
                Tables\Filters\SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->multiple()
                    ->preload()
                    ->label('Brand'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->placeholder('All'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->trueLabel('Yes')
                    ->falseLabel('No')
                    ->placeholder('All'),

                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('min_price')
                                    ->numeric()
                                    ->label('Min Price')
                                    ->prefix('EGP'),
                                Forms\Components\TextInput::make('max_price')
                                    ->numeric()
                                    ->label('Max Price')
                                    ->prefix('EGP'),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn (Builder $query, $price): Builder => $query->where('price', '>=', $price)
                            )
                            ->when(
                                $data['max_price'],
                                fn (Builder $query, $price): Builder => $query->where('price', '<=', $price)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['min_price'] ?? null) {
                            $indicators['min_price'] = 'Min price: EGP' . number_format($data['min_price'], 2);
                        }
                        if ($data['max_price'] ?? null) {
                            $indicators['max_price'] = 'Max price: EGP' . number_format($data['max_price'], 2);
                        }
                        return $indicators;
                    }),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
