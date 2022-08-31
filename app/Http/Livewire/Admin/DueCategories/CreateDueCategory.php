<?php

namespace App\Http\Livewire\Admin\DueCategories;

use Livewire\Component;
use App\Models\DueCategory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateDueCategory extends Component
{
    public $open = false;

    public $name = [];

    protected $listeners = [
        'openCreateDueCategoryModal' => 'openModal',
        'closeCreateDueCategoryModal' => 'closeModal',
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
        $this->reset(["name",]);
    }

    public function storeDueCategory()
    {
        $this->validate([
            "name.en" => "required|max:255|string",
            "name.*" => "nullable|max:255|string",
        ]);

        $latest_due_category = DueCategory::withoutGlobalScope('ordered')->orderBy('order', 'DESC')->first();
        $next_order = $latest_due_category ? $latest_due_category->order + 1 : 1;

        DueCategory::create([
            "name" => [
                'en' => $this->name['en'],
                'ar' => $this->name['ar'] ?? $this->name['en'],
            ],
            'order' => $next_order,
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.due_category_created'));
    }

    public function render()
    {
        return view('livewire-components.admin.due-categories.create-due-category');
    }
}