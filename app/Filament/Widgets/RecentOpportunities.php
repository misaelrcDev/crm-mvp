<?php

namespace App\Filament\Widgets;

use App\Models\Opportunity;
use Filament\Widgets\Widget;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class RecentOpportunities extends Widget
{
    protected static string $view = 'filament.widgets.recent-opportunities';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;





    // public function render(): View
    // {
    //     return view('filament.widgets.recent-opportunities', [
    //         'opportunities' => Opportunity::whereNotNull('stage_id')
    //             ->latest()
    //             ->paginate(5), // Livewire reconhece a paginação agora
    //     ]);
    // }
}
