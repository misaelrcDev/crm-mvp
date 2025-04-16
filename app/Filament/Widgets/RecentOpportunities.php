<?php

namespace App\Filament\Widgets;

use App\Models\Opportunity;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Collection;

class RecentOpportunities extends Widget
{
    protected static string $view = 'filament.widgets.recent-opportunities';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public Collection $opportunities;

    public function mount()
    {
        $this->opportunities = Opportunity::latest()
            ->take(10)
            ->whereNotNull('stage_id')
            ->get();
    }
}
