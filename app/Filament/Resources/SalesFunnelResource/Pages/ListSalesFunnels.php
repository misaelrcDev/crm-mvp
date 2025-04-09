<?php

namespace App\Filament\Resources\SalesFunnelResource\Pages;

use App\Filament\Resources\SalesFunnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesFunnels extends ListRecords
{
    protected static string $resource = SalesFunnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
