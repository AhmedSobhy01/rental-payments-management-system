<?php

namespace App\Http\Livewire\Admin\Buildings;

use Livewire\Component;
use App\Models\Building;

class EditBuilding extends Component
{
    public $open = false;

    public $building_id;
    public $address = [];
    public $number;

    protected $listeners = [
        'openEditBuildingModal' => 'openModal',
        'closeEditBuildingModal' => 'closeModal',
    ];

    protected $rules = [
        'address' => 'required|array',
    ];

    public function openModal($buidling_id)
    {
        $building = Building::findOrFail($buidling_id);

        $this->building_id = $building->id;
        $this->address['en'] = $building->getTranslation('address', 'en');
        $this->address['ar'] = $building->getTranslation('address', 'ar');
        $this->number = $building->number;

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["address", "number", "building_id",]);
    }

    public function updateBuilding()
    {
        $this->validate([
            "address.en" => "required|max:255|string",
            "address.*" => "nullable|max:255|string",
            "number" => "required|string",
        ]);

        $building = Building::findOrFail($this->building_id);

        $building->update([
            "address" => [
                'en' => $this->address['en'],
                'ar' => $this->address['ar'] ?? $this->address['en'],
            ],
            "number" => $this->number,
        ]);

        $this->emit("success", __('messages.building_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.buildings.edit-building');
    }
}