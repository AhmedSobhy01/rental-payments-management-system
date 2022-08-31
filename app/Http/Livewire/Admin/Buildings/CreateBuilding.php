<?php

namespace App\Http\Livewire\Admin\Buildings;

use App\Models\Apartment;
use App\Models\Building;
use Livewire\Component;

class CreateBuilding extends Component
{
    public $open = false;

    public $address = [];
    public $number;
    public $floors;
    public $apartments_on_floor;
    public $basement = false;

    protected $listeners = [
        'openCreateBuildingModal' => 'openModal',
        'closeCreateBuildingModal' => 'closeModal',
    ];

    protected $rules = [
        'address' => 'required|array',
    ];

    public function openModal()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["address", "number", "floors", "apartments_on_floor", "basement",]);
    }

    public function storeBuilding()
    {
        $this->validate([
            "address.en" => "required|max:255|string",
            "address.*" => "nullable|max:255|string",
            "number" => "required|string",
            "floors" => "required|min:1|integer",
            "apartments_on_floor" => "required|min:1|integer",
            "basement" => "nullable|boolean"
        ]);

        $building = Building::create([
            "address" => [
                'en' => $this->address['en'],
                'ar' => $this->address['ar'] ?? $this->address['en'],
            ],
            "number" => $this->number,
        ]);

        $apartments = [];

        if ($this->basement) {
                $apartments[] = new Apartment([
                'floor' => 0,
                'number' => 1,
            ]);
        }

        foreach (range(1, $this->floors) as $floor) {
            foreach (range(1, $this->apartments_on_floor) as $apartment) {
                $apartments[] = new Apartment([
                    'floor' => $floor,
                    'number' => $apartment,
                ]);
            }
        }

        $building->apartments()->saveMany($apartments);

        $this->closeModal();
        $this->emit("success", __('messages.building_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.buildings.create-building');
    }
}