<?php

namespace App\Http\Livewire\Admin\Tenants;

use App\Models\Due;
use App\Models\Tenant;
use App\Models\DueCategory;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ShowTenant extends Component
{
    public $tenant_id;
    public $tenant;

    public $due_categories;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->due_categories = DueCategory::all();
        $this->tenant_id = request()->tenant;
    }

    public function destroyTenant()
    {
        $tenant = Tenant::findOrFail($this->tenant_id);

        $tenant->delete();

        session()->flash("success", __('messages.tenant_deleted'));

        redirect()->route('admin.tenants.index');
    }

    public function toggleDueStatus($due_id)
    {
        $due = Due::find($due_id);

        if (!$due) return $this->emit('error', __('messages.due_not_found'));

        $due->paid_amount = $due->amount_left > 0 ? $due->amount - $due->discount : 0;
        $due->save();

        $this->emit('success', $due->paid ? __('messages.due_marked_paid') : __('messages.due_marked_unpaid'));
    }

    public function destroyDue($due_id)
    {
        $due = Due::find($due_id);

        if (!$due) return $this->emit('success', __('messages.due_not_found'));

        $due->delete();

        $this->emit('success', __('messages.due_deleted'));
    }

    public function render()
    {
        $this->tenant = Tenant::with([
                            "contracts" => fn ($q) => $q->latest('start_date'),
                            "nationality",
                            "dues" => fn ($q) => $q->latest()
                        ])
                        ->withCount([
                            "dues AS total_unpaid_dues_amount" => fn ($q) => $q->select(DB::raw('(SUM(amount) - SUM(paid_amount) - SUM(discount)) / 100')),
                            "dues AS total_paid_dues_amount" => fn ($q) => $q->select(DB::raw('SUM(paid_amount) / 100')),
                        ])
                        ->findOrFail($this->tenant_id);

        return view('livewire-components.admin.tenants.show-tenant');
    }
}