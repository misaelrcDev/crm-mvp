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
use Illuminate\Support\Facades\Auth;

class StageResource extends Resource
{
    protected static ?string $model = Stage::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getModelLabel(): string
    {
        return __('Estágios');
    }

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('sales_funnel_id')
                //     ->relationship('salesFunnel', 'name')
                //     ->label('Funil de Vendas')
                //     ->required(),

                Select::make('name')
                    ->label('Nome do Estágio')
                    ->options([
                        'Contato Inicial' => 'Contato Inicial',
                        'Proposta Enviada' => 'Proposta Enviada',
                        'Negociação' => 'Negociação',
                        'Fechado (Ganho)' => 'Fechado (Ganho)',
                        'Fechado (Perdido)' => 'Fechado (Perdido)',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Ajusta automaticamente a ordem com base no estágio selecionado
                        $set('order', match ($state) {
                            'Contato Inicial' => 1,
                            'Proposta Enviada' => 2,
                            'Negociação' => 3,
                            'Fechado (Ganho)' => 4,
                            'Fechado (Perdido)' => 5,
                            default => null,
                        });
                    }),


                TextInput::make('order')
                    ->label('Ordem')
                    ->hiddenOn(['edit', 'create'])
                    ->numeric()
                    ->minValue(1)
                    ->step(1),

                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('salesFunnel.name')
                //     ->label('Funil de Vendas')
                //     ->sortable(),

                TextColumn::make('name')
                    ->label('Nome do Estágio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('order')
                    ->label('Ordem'),

                // TextColumn::make('created_at')
                //     ->label('Criado em')
                //     ->dateTime('d/m/y H:i')
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(fn ($stage) => false); // Impede edições
        static::deleting(fn ($stage) => false); // Impede exclusões
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
