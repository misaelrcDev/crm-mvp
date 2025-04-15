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
        ->whereHas('stage', fn(Builder $query) => $query->where('name', 'Contato Inicial'))
        ->count();

        $dataPropostaEnviada = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', fn(Builder $query) => $query->where('name', 'Proposta Enviada'))
            ->count();

        $dataNegociacao = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', fn(Builder $query) => $query->where('name', 'Negociação'))
            ->count();

        $dataFechadoGanho = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', fn(Builder $query) => $query->where('name', 'Fechado (Ganho)'))
            ->count();

        $dataFechadoPerdido = \App\Models\Opportunity::where('user_id', $userId)
            ->whereHas('stage', fn(Builder $query) => $query->where('name', 'Fechado (Perdido)'))
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Oportunidades',
                    'data' =>
                    [
                        $dataContatoInicial,
                        $dataPropostaEnviada,
                        $dataNegociacao,
                        $dataFechadoGanho,
                        $dataFechadoPerdido
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                      ],
                      'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                      ],
                      'borderWidth' => 1
                ],
            ],
            'labels' => ['Contato Inicial', 'Proposta Enviada', 'Negociação', 'Fechado (Ganho)', 'Fechado (Perdido)'],
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
