<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class OpportunitiesOverview extends ChartWidget
{
    protected static ?string $heading = 'Oportunidades';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Oportunidades',
                    'data' => [
                        \App\Models\Opportunity::where('stage_id', 1)->count(),
                        \App\Models\Opportunity::where('stage_id', 2)->count(),
                        // \App\Models\Opportunity::where('status', 'Aberto')->count(),
                    ],
                ],
            ],
            'labels' => ['Contato Inicial', 'Proposta Enviada'],

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
