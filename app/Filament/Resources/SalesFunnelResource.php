<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesFunnelResource\Pages;
use App\Filament\Resources\SalesFunnelResource\RelationManagers;
use App\Models\SalesFunnel;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesFunnelResource extends Resource
{
    protected static ?string $model = SalesFunnel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nome do Funil')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Descrição')
                    ->maxLength(500)
                    ->placeholder('Breve descrição sobre o funil de vendas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome do Funil')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),


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
            'index' => Pages\ListSalesFunnels::route('/'),
            'create' => Pages\CreateSalesFunnel::route('/create'),
            'edit' => Pages\EditSalesFunnel::route('/{record}/edit'),
        ];
    }
}
