<?php

namespace App\Http\Livewire\Admin\Tenants;

use App\Models\Tenant;
use Livewire\Component;
use App\Models\Nationality;

class EditTenant extends Component
{
    public $open = false;

    public $nationalities;

    public $tenant_id;
    public $name = [];
    public $email;
    public $phone;
    public $birthday;
    public $nationality_id;
    public $national_card_no;
    public $passport_no;
    public $married;

    protected $listeners = [
        'openEditTenantModal' => 'openModal',
        'closeEditTenantModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array',
    ];

    public function mount()
    {
        $this->nationalities = Nationality::orderBy('name', 'ASC')->get();
    }

    public function openModal($tenant_id)
    {
        $tenant = Tenant::with(['nationality'])->findOrFail($tenant_id);

        $this->tenant_id = $tenant->id;
        $this->name['en'] = $tenant->getTranslation('name', 'en');
        $this->name['ar'] = $tenant->getTranslation('name', 'ar');
        $this->email = $tenant->email;
        $this->phone = $tenant->phone;
        $this->birthday = $tenant->birthday;
        $this->nationality_id = $tenant->nationality_id;
        $this->national_card_no = $tenant->national_card_no;
        $this->passport_no = $tenant->passport_no;
        $this->married = $tenant->married;

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["name", "email", "phone", "birthday", "nationality_id", "national_card_no", "passport_no", "married", "tenant_id",]);
    }

    public function updateTenant()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
            "email" => "nullable|max:255|email|unique:tenants,email," . $this->tenant_id,
            "phone" => "nullable|max:20|unique:tenants,phone," . $this->tenant_id,
            "birthday" => "required|date",
            "nationality_id" => "required|integer|exists:nationalities,id",
            "national_card_no" => "nullable|numeric",
            "passport_no" => "nullable|string",
            "married" => "required|boolean",
        ]);

        Tenant::findOrFail($this->tenant_id)->update([
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

        $this->emit("success", __('messages.tenant_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.tenants.edit-tenant');
    }
}