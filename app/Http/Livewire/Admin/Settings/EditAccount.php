<?php

namespace App\Http\Livewire\Admin\Settings;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditAccount extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'requried|array'
    ];

    public function mount()
    {
        $this->name = [
            'en' => auth()->user()->getTranslation('name', 'en'),
            'ar' => auth()->user()->getTranslation('name', 'ar'),
        ];

        $this->email = auth()->user()->email;
    }

    public function updateAccount()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
            "email" => "required|max:255|email|unique:users,email," . auth()->id(),
            "password" => "nullable|min:8|confirmed",
        ]);

        auth()->user()->update([
            'name' => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
            'email' => $this->email,
        ]);

        if ($this->password) {
            auth()->user()->update([
                'password' => Hash::make($this->password)
            ]);
        }

        $this->reset(['password', 'password_confirmation']);

        $this->emit("success", __('messages.account_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.settings.edit-account');
    }
}