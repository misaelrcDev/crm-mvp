<?php

namespace App\Filament\Widgets;

use App\Models\Opportunity;
use App\Models\SalesFunnel;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class SalesFunnelsOverview extends ChartWidget
{
    protected static ?string $heading = 'Oportunidades por Funil de Vendas';
    //dimnuir o tamanho do gráfico

    protected function getData(): array
    {

        $funnels = SalesFunnel::pluck('name', 'id')->toArray();
        $salesFunnels = SalesFunnel::all();
        $data = [];



        foreach ($funnels as $id => $name) {
            $data[] = Opportunity::where('sales_funnel_id', $id)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => "Oportunidades",
                    'data' => $data,
                    'backgroundColor' => ['rgb(46, 204, 113)', 'rgb(52, 152, 219)', 'rgb(243, 156, 18)', 'rgb(231, 76, 60)', 'rgb(155, 89, 182)'],
                    'borderColor' => ['rgb(255, 255, 255)', 'rgb(255, 255, 255)', 'rgb(255, 255, 255)', 'rgb(255, 255, 255)', 'rgb(255, 255, 255)'],
                    'borderWidth' => 2,
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => array_values($funnels),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array|RawJs|null
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => false,
                    'ticks' => [
                        'stepSize' => 1,
                        'callback' => 'function(value) { return value + "%"; }',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }


}
