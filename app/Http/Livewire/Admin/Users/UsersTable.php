<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $header = true;
    public $permissions;

    public $query = "";

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function deleteUser(int $user_id)
    {
        if (auth()->id() == $user_id) return $this->emit("error", __('messages.same_logged_user'));

        $user = User::findOrFail($user_id);

        $user->delete();

        $this->emit("success", __('messages.user_deleted'));
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = trim($this->query);

        $users =  User::when(str_starts_with($query, "id:"), function ($q) use ($query) {
                        return $q->where('id', substr($query, 3));
                    }, function ($q) use ($query) {
                        $q->where('name->en', 'LIKE', '%' . $query . '%')
                            ->orWhere('name->ar', 'LIKE', '%' . $query . '%')
                            ->orWhere('email', 'LIKE', '%' . $query . '%');
                    })
                    ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.users.users-table', compact("users"));
    }
}
