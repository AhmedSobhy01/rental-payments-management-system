<?php

namespace App\Http\Livewire\Admin\Buildings;

use App\Models\Building;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowBuilding extends Component
{
    public $building_id;
    public $building;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->building_id = request()->building;
    }


    public function destroyBuilding()
    {
        $building = Building::withCount('contracts')
                        ->findOrFail($this->building_id);

        if ($building->contracts_count) return $this->emit("error", __('messages.building_has_contracts'));

        try {
            DB::beginTransaction();

            $building->apartments()->delete();
            $building->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        session()->flash("success", __('messages.building_deleted'));
        redirect()->route('admin.buildings.index');
    }

    public function render()
    {
        $this->building =  Building::with(['apartments', 'contracts'])
                                ->withCount(['apartments' => fn ($q) => $q->where('floor', '!=', 0)])
                                ->withMax('apartments', 'floor')
                                ->findOrFail($this->building_id);

        return view('livewire-components.admin.buildings.show-building');
    }
}