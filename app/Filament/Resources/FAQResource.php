<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FAQResource\Pages;
use App\Filament\Resources\FAQResource\RelationManagers;
use App\Models\FAQ;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FAQResource extends Resource
{
    protected static ?string $model = FAQ::class;
    protected static ?string $navigationGroup = 'Global';
    protected static ?string $navigationLabel = 'FAQ';
    protected static ?string $tableLabel = 'Frequently Asked Questions';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('FAQ Details')->schema([
                    Forms\Components\TextInput::make('question')
                        ->required()
                        ->label('Question'),
                    Forms\Components\Textarea::make('answer')
                        ->required()
                        ->label('Answer'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Is Active')
                        ->default(true),
                    Forms\Components\TextInput::make('order')
                        ->numeric()
                        ->label('Order'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')->searchable()->label('question'),
                Tables\Columns\TextColumn::make('answer')->limit(50)->label('answer'),
                Tables\Columns\ToggleColumn::make('is_active')->label('is_active'),
                Tables\Columns\TextColumn::make('order')->label('order'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('created_at'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListFAQS::route('/'),
            'create' => Pages\CreateFAQ::route('/create'),
            'edit' => Pages\EditFAQ::route('/{record}/edit'),
        ];
    }
}
