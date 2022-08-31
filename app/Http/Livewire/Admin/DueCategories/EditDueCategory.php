<?php

namespace App\Http\Livewire\Admin\DueCategories;

use App\Models\DueCategory;
use Livewire\Component;

class EditDueCategory extends Component
{
    public $open = false;

    public $due_category_id;
    public $name = [];

    protected $listeners = [
        'openEditDueCategoryModal' => 'openModal',
        'closeEditDueCategoryModal' => 'closeModal',
    ];

    protected $rules = [
        'name' => 'required|array',
    ];

    public function openModal($due_category_id)
    {
        $due_category = DueCategory::findOrFail($due_category_id);

        $this->due_category_id = $due_category_id;
        $this->name['en'] = $due_category->getTranslation('name', 'en');
        $this->name['ar'] = $due_category->getTranslation('name', 'ar');

        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["name", "due_category_id",]);
    }

    public function updateDueCategory()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
        ]);

        DueCategory::findOrFail($this->due_category_id)->update([
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
        ]);

        $this->emit("success", __('messages.due_category_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.due-categories.edit-due-category');
    }
}