<?php

namespace App\Http\Livewire\Admin\Contracts;

use Livewire\Component;
use App\Models\Building;
use App\Models\Contract;
use App\Models\Apartment;

class EditContract extends Component
{
    public $open = false;

    public $buildings = [];
    public $floors = [];
    public $apartments = [];

    public $contract_id;
    public $start_date;
    public $duration;
    public $rent_amount;

    public $building_id;
    public $floor_no;
    public $apartment_id;

    protected $listeners = [
        'openEditContractModal' => 'openModal',
        'closeEditContractModal' => 'closeModal',
    ];

    public function openModal($contract_id)
    {
        $this->contract_id = $contract_id;
        $contract = Contract::findOrFail($this->contract_id);

        $this->start_date = $contract->start_date->format('Y-m-d');
        $this->duration = $contract->duration;
        $this->rent_amount = $contract->rent_amount;
        $this->building_id = $contract->apartment->building_id;
        $this->floor_no = $contract->apartment->floor;
        $this->apartment_id = $contract->apartment->id;

        $this->buildings = Building::all();
        $this->floors = range(1, Apartment::where('building_id', $this->building_id)->max('floor'));
        $this->apartments = Apartment::where('building_id', $this->building_id)->where('floor', $this->floor_no)->get();

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["contract_id", "buildings", "floors", "apartments", "start_date", "duration", "apartment_id", "building_id", "floor_no",]);
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
        ]);

        Contract::findOrFail($this->contract_id)->update([
            "start_date" => $this->start_date,
            "duration" => $this->duration,
            "rent_amount" => $this->rent_amount,
            "apartment_id" => $this->apartment_id,
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.contract_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.contracts.edit-contract');
    }
}