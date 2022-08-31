<?php

namespace App\Http\Livewire\Admin\Nationalities;

use App\Models\Nationality;
use Livewire\Component;

class EditNationality extends Component
{
    public $open = false;

    public $nationality_id;
    public $code;
    public $name = [];

    protected $listeners = [
        'openEditNationalityModal' => 'openModal',
        'closeEditNationalityModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array',
    ];

    public function openModal($nationality_id)
    {
        $nationality = Nationality::findOrFail($nationality_id);

        $this->nationality_id = $nationality_id;
        $this->code = $nationality->code;
        $this->name['en'] = $nationality->getTranslation('name', 'en');
        $this->name['ar'] = $nationality->getTranslation('name', 'ar');

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["code", "name", "nationality_id",]);
    }

    public function updateNationality()
    {
        $this->validate([
            "code" => "required|max:255|string",
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
        ]);

        Nationality::findOrFail($this->nationality_id)->update([
            "code" => $this->code,
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
        ]);

        $this->emit("success", __('messages.nationality_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.nationalities.edit-nationality');
    }
}