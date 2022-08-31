<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class EditUser extends Component
{
    public $open = false;

    public $user_id;
    public $name = [];
    public $email;
    public $password;
    public $password_confirmation;

    protected $listeners = [
        'openEditUserModal' => 'openModal',
        'closeEditUserUserModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array'
    ];

    public function openModal($user_id)
    {
        $user = User::findOrFail($user_id);

        $this->user_id = $user->id;
        $this->name['en'] = $user->getTranslation('name', 'en');
        $this->name['ar'] = $user->getTranslation('name', 'ar');
        $this->email = $user->email;

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["name", "email", "password", "password_confirmation", "user_id",]);
    }

    public function updateUser()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
            "email" => "required|max:255|email|unique:users,email," . $this->user_id,
            "password" => 'nullable|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->user_id);

        $user->update([
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
            "email" => $this->email,
        ]);

        if ($this->password) {
            User::findOrFail($this->user_id)->update([
                "password" => Hash::make($this->password),
            ]);
        }

        $this->emit("success", __('messages.user_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.users.edit-user');
    }
}