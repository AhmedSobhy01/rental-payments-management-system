<?php

namespace App\Http\Livewire\Admin\ActivityLog;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogTable extends Component
{
    use WithPagination;

    public $header = true;

    public $query = "";

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function destroyLog($log_id)
    {
        $log = ActivityLog::findOrFail($log_id);

        if ($log) return $this->emit('error', __('messages.log_not_found'));

        $log->delete();

        $this->emit('success', __('messages.log_deleted'));
    }

    public function render()
    {
        $query = trim($this->query);

        $logs =  ActivityLog::with(['tenant', 'user'])
                    ->when(str_starts_with($query, "id:"), function ($q) use ($query) {
                        return $q->where('id', substr($query, 3));
                    }, function ($q) use ($query) {
                        $q->where('ip', 'LIKE', '%' . $query . '%')
                            ->orWhere('agent', 'LIKE', '%' . $query . '%');
                    })
                    ->latest()
                    ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.activity-log.activity-log-table', compact("logs"));
    }
}