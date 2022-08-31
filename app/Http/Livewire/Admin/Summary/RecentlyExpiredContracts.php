<?php

namespace App\Http\Livewire\Admin\Summary;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class RecentlyExpiredContracts extends Component
{
    use WithPagination;

    public function render()
    {
        $contracts = Contract::with(['tenant'])
                        ->recentlyExpired()
                        ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.summary.recently-expired-contracts', compact('contracts'));
    }
}