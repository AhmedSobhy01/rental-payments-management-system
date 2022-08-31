<?php

namespace App\Http\Livewire\Admin\Buildings;

use App\Models\Building;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BuildingsTable extends Component
{
    use WithPagination;

    public $header = true;

    public $query = "";

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function destroyBuilding(int $building_id)
    {
        $building = Building::withCount(['contracts'])
                        ->findOrFail($building_id);

        if ($building->contracts_count) return $this->emit("error", __('messages.building_has_contracts'));

        try {
            DB::beginTransaction();

            $building->apartments()->delete();
            $building->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->emit("success", __('messages.building_deleted'));
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = trim($this->query);

        $buildings =  Building::with(['apartments',])
                        ->withCount(['apartments' => fn ($q) => $q->where('floor', '!=', 0)])
                        ->withMax('apartments', 'floor')
                        ->when(str_starts_with($query, "id:"), function ($q) use ($query) {
                            return $q->where('id', substr($query, 3));
                        }, function ($q) use ($query) {
                            $q->where('address->en', 'LIKE', '%' . $query . '%')
                                ->orWhere('address->ar', 'LIKE', '%' . $query . '%');
                        })
                        ->latest()
                        ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.buildings.buildings-table', compact("buildings"));
    }
}