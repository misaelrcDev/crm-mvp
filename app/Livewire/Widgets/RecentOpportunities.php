<?php

namespace App\Livewire\Widgets;

use App\Models\Opportunity;
use Livewire\Component;
use Livewire\WithPagination;

class RecentOpportunities extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public int $perPage = 5;

    public function render()
    {
        return view('livewire.widgets.recent-opportunities', [
            'opportunities' => Opportunity::whereNotNull('stage_id')
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
