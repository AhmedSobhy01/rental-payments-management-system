<?php

namespace App\Http\Livewire\Admin\Tenants;

use App\Models\Tenant;
use Livewire\Component;
use App\Models\Nationality;

class CreateTenant extends Component
{
    public $open = false;

    public $nationalities;

    public $name = [];
    public $email;
    public $phone;
    public $birthday;
    public $nationality_id;
    public $national_card_no;
    public $passport_no;
    public $married = false;

    protected $listeners = [
        'openCreateTenantModal' => 'openModal',
        'closeCreateTenantModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array',
    ];

    public function mount()
    {
        $this->nationalities = Nationality::orderBy('name', 'ASC')->get();
    }

    public function openModal()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["name", "email", "phone", "birthday", "nationality_id", "national_card_no", "passport_no", "married",]);
    }

    public function storeTenant()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
            "email" => "nullable|max:255|email|unique:tenants,email",
            "phone" => "nullable|max:20|unique:tenants,phone",
            "birthday" => "required|date",
            "nationality_id" => "required|integer|exists:nationalities,id",
            "national_card_no" => "nullable|numeric",
            "passport_no" => "nullable|string",
            "married" => "required|boolean",
        ]);

        Tenant::create([
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
            "email" => $this->email,
            "phone" => $this->phone,
            "birthday" => $this->birthday,
            "nationality_id" => $this->nationality_id,
            "national_card_no" => $this->national_card_no,
            "passport_no" => $this->passport_no,
            "married" => $this->married,
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.tenant_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.tenants.create-tenant');
    }
}