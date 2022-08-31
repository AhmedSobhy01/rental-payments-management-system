<?php

namespace App\Http\Livewire\Admin\DueCategories;

use App\Models\DueCategory;
use Livewire\Component;
use Livewire\WithPagination;

class DueCategoriesTable extends Component
{
    use WithPagination;

    public $header = true;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function updateDuecategoryOrder($due_categories)
    {
        foreach ($due_categories as $due_category) {
            DueCategory::find($due_category['value'])->update([
                "order" => $due_category['order'],
            ]);
        }
    }

    public function destroyDueCategory($due_category)
    {
        $due_category = DueCategory::withCount('dues')->findOrFail($due_category);

        if ($due_category->dues_count) return $this->emit('error', __('messages.due_category_has_dues'));

        $due_category->delete();

        $this->emit('success', __('due_category_deleted'));
    }

    public function render()
    {
        $due_categories =  DueCategory::paginate(config('custom.pagination_count'));

        return view('livewire-components.admin.due-categories.due-categories-table', compact("due_categories"));
    }
}