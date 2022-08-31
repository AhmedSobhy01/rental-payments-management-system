<?php

namespace App\Http\Livewire\Admin\Nationalities;

use App\Models\Nationality;
use Livewire\Component;

class CreateNationality extends Component
{
    public $open = false;

    public $code;
    public $name = [];

    protected $listeners = [
        'openCreateNationalityModal' => 'openModal',
        'closeCreateNationalityModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array',
    ];

    public function openModal()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["code", "name",]);
    }

    public function storeNationality()
    {
        $this->validate([
            "code" => "required|max:255|string",
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
        ]);

        Nationality::create([
            "code" => $this->code,
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.nationality_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.nationalities.create-nationality');
    }
}