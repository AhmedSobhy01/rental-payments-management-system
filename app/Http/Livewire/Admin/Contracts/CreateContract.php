<?php

namespace App\Http\Livewire\Admin\Contracts;

use Livewire\Component;
use App\Models\Building;
use App\Models\Contract;
use App\Models\Apartment;

class CreateContract extends Component
{
    public $open = false;

    public $buildings = [];
    public $floors = [];
    public $apartments = [];

    public $tenant_id;
    public $start_date;
    public $duration;
    public $rent_amount;

    public $building_id;
    public $floor_no;
    public $apartment_id;

    protected $listeners = [
        'openCreateContractModal' => 'openModal',
        'closeCreateContractModal' => 'closeModal',
    ];

    public function openModal($tenant_id)
    {
        $this->tenant_id = $tenant_id;

        $this->buildings = Building::all();

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["buildings", "floors", "apartments", "tenant_id", "start_date", "duration", "apartment_id", "building_id", "floor_no",]);
    }

    public function updatedBuildingId()
    {
        $this->validate([
            'building_id' => 'required|integer|exists:buildings,id',
        ]);

        $this->floor_no = null;
        $this->floors = range(1, Apartment::where('building_id', $this->building_id)->max('floor'));
    }

    public function updatedFloorNo()
    {
        $this->apartment_id = null;
        $this->apartments = Apartment::where('building_id', $this->building_id)->where('floor', $this->floor_no)->get();
    }

    public function storeDue()
    {
        $this->validate([
            "start_date" => "required|date",
            "duration" => "required|max:50|numeric",
            "rent_amount" => "required|numeric",
            "building_id" => "required|integer|exists:buildings,id",
            "floor_no" => "required|integer",
            "apartment_id" => "required|integer|exists:apartments,id",
            "tenant_id" => "required|integer|exists:tenants,id",
        ]);

        $contract = Contract::create([
            "start_date" => $this->start_date,
            "duration" => $this->duration,
            "rent_amount" => $this->rent_amount,
            "apartment_id" => $this->apartment_id,
            "tenant_id" => $this->tenant_id,
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.contract_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.contracts.create-contract');
    }
}