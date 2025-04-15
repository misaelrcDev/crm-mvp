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
