<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpportunityResource\Pages;
use App\Filament\Resources\OpportunityResource\RelationManagers;
use App\Models\Opportunity;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class OpportunityResource extends Resource
{
    protected static ?string $model = Opportunity::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getModelLabel(): string
    {
        return __('Oportunidades');
    }

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('stage_id')
                    ->relationship('stage', 'name')
                    ->label('Estágio')
                    ->required(),

                Select::make('contact_id')
                    ->relationship('contact', 'name')
                    ->label('Contato')
                    ->required(),

                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                TextInput::make('value')
                    ->label('Valor (R$)')
                    ->numeric()
                    ->required()
                    ->prefix('R$'),

                Select::make('sales_funnel_id')
                    ->label('Funil de Vendas')
                    ->options(\App\Models\SalesFunnel::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Textarea::make('note')
                    ->label('Anotações')
                    ->maxLength(500),

                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stage.name')
                    ->label('Estagio'),

                TextColumn::make('title')
                    ->label('Título')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('contact.name')
                    ->label('Contato'),

                TextColumn::make('value')
                    ->label('Valor (R$)')
                    ->money('BRL'),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),
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
            'index' => Pages\ListOpportunities::route('/'),
            'create' => Pages\CreateOpportunity::route('/create'),
            'edit' => Pages\EditOpportunity::route('/{record}/edit'),
        ];
    }
}
