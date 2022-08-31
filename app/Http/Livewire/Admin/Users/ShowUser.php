<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class ShowUser extends Component
{
    public $user_id;
    public $user;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->user_id = request()->user;
    }

    public function destroyUser()
    {
        if (auth()->id() == $this->user_id) return $this->emit("error", __('messages.same_logged_user'));

        $user = User::findOrFail($this->user_id);

        $user->delete();

        session()->flash("success", __('messages.user_deleted'));

        redirect()->route('admin.users.index');
    }

    public function render()
    {
        $this->user = User::findOrFail($this->user_id);

        return view('livewire-components.admin.users.show-user');
    }
}
