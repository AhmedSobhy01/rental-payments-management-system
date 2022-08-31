<?php

namespace App\Http\Livewire\Admin\Tenants;

use App\Models\Due;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Contract;
use App\Models\DueCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TenantsTable extends Component
{
    use WithPagination;

    public $header = true;

    public $query = "";

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function addMonthlyRentDue()
    {
        $monthly_rent_id = DueCategory::where('name->en', 'Monthly Rent')->first()->id;

        $active_contracts = Contract::with(['tenant'])
                                ->active()
                                ->latest()
                                ->get();

        foreach ($active_contracts as $contract) {
            $due = new Due([
                'due_category_id' => $monthly_rent_id,
                'amount' => $contract->rent_amount,
                'discount' => 0,
                'paid_amount' => 0,
                'created_at' => date('Y-m-01'),
            ]);

            $contract->tenant->dues()->save($due);
        }

        $this->emit("success", __('messages.monthly_rent_due_added'));
    }

    public function destroyTenant(int $tenant_id)
    {
        Tenant::findOrFail($tenant_id)->delete();

        $this->emit("success", __('messages.tenant_deleted'));
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = trim($this->query);

        $tenants =  Tenant::with(['contracts', 'nationality'])
                    ->withCount([
                        'dues' => fn ($q) => $q->unpaid(),
                        "dues AS total_unpaid_dues_amount" => fn ($q) => $q->select(DB::raw('(SUM(amount) - SUM(paid_amount) - SUM(discount)) / 100')),
                    ])
                    ->when(str_starts_with($query, "id:"), function ($q) use ($query) {
                        return $q->where('id', substr($query, 3));
                    }, function ($q) use ($query) {
                        $q->where('name->en', 'LIKE', '%' . $query . '%')
                            ->orWhere('name->ar', 'LIKE', '%' . $query . '%')
                            ->orWhere('email', 'LIKE', '%' . $query . '%')
                            ->orWhere('phone', 'LIKE', '%' . $query . '%')
                            ->orWhere('national_card_no', 'LIKE', '%' . $query . '%')
                            ->orWhere('passport_no', 'LIKE', '%' . $query . '%');
                    })
                    ->latest()
                    ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.tenants.tenants-table', compact("tenants"));
    }
}