<?php

namespace App\Filament\Widgets;

use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class OpportunitiesOverview extends ChartWidget
{
    protected static ?string $heading = 'Resumo de Oportunidades por Estágio';

    protected function getData(): array
    {
        $userId = Auth::id();

        $dataContatoInicial = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', function (Builder $query) {
                $query->where('name', 'Contato Inicial');
            })
            ->count();

        $dataPropostaEnviada = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', function (Builder $query) {
                $query->where('name', 'Proposta Enviada');
            })
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Oportunidades',
                    'data' => [$dataContatoInicial, $dataPropostaEnviada],
                ],
            ],
            'labels' => ['Contato Inicial', 'Proposta Enviada'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array|RawJs|null
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
