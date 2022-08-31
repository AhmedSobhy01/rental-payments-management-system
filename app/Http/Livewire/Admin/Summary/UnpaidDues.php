<?php

namespace App\Http\Livewire\Admin\Summary;

use App\Models\Due;
use Livewire\Component;
use Livewire\WithPagination;

class UnpaidDues extends Component
{
    use WithPagination;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function destroyDue($due_id)
    {
        $due = Due::find($due_id);

        if (!$due) return $this->emit('error', __('messages.due_not_found'));

        $due->delete();

        $this->emit('success', __('messages.due_deleted'));
    }

    public function render()
    {
        $dues = Due::with('tenant')
                    ->unpaid()
                    ->latest()
                    ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.summary.unpaid-dues', compact('dues'));
    }
}