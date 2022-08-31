<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateUser extends Component
{
    public $open = false;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $listeners = [
        'openCreateUserModal' => 'openModal',
        'closeCreateUserModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array'
    ];

    public function openModal()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["name", "email", "password", "password_confirmation",]);
    }

    public function storeUser()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
            "email" => "required|max:255|email|unique:users,email",
            "password" => 'required|min:8|confirmed',
        ]);

        User::create([
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
            "email" => $this->email,
            "password" => Hash::make($this->password),
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.user_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.users.create-user');
    }
}