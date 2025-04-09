<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StageResource\Pages;
use App\Filament\Resources\StageResource\RelationManagers;
use App\Models\Stage;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StageResource extends Resource
{
    protected static ?string $model = Stage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('sales_funnel_id')
                    ->relationship('salesFunnel', 'name')
                    ->label('Funil de Vendas')
                    ->required(),

                TextInput::make('name')
                    ->label('Nome do Estágio')
                    ->required()
                    ->maxLength(255),

                TextInput::make('order')
                    ->label('Ordem')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->step(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('salesFunnel.name')
                    ->label('Funil de Vendas')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nome do Estágio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('order')
                    ->label('Ordem'),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/y H:i')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStages::route('/'),
            'create' => Pages\CreateStage::route('/create'),
            'edit' => Pages\EditStage::route('/{record}/edit'),
        ];
    }
}
