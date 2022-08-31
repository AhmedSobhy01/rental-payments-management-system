<?php

namespace App\Http\Livewire\Admin\Nationalities;

use App\Models\Nationality;
use Livewire\Component;
use Livewire\WithPagination;

class NationalitiesTable extends Component
{
    use WithPagination;

    public $header = true;

    public $query = "";

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function destroyNationality($nationality_id)
    {
        $nationality = Nationality::withCount('tenants')->findOrFail($nationality_id);

        if ($nationality->tenants_count) return $this->emit('error', __('messages.nationality_has_tenants'));

        $nationality->delete();

        $this->emit('success', __('messages.nationality_deleted'));
    }

    public function render()
    {
        $query = trim($this->query);

        $nationalities =  Nationality::when(str_starts_with($query, "id:"), function ($q) use ($query) {
                            return $q->where('id', substr($query, 3));
                        }, function ($q) use ($query) {
                            $q->where('name->en', 'LIKE', '%' . $query . '%')
                                ->orWhere('name->ar', 'LIKE', '%' . $query . '%')
                                ->orWhere('code', 'LIKE', '%' . $query . '%');
                        })
                        ->latest()
                        ->paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.nationalities.nationalities-table', compact("nationalities"));
    }
}