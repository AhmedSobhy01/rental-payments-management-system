<?php

namespace App\Http\Livewire\Admin\Dues;

use App\Models\Due;
use App\Models\DueCategory;
use Livewire\Component;

class EditDue extends Component
{
    public $open = false;

    public $dues_categories;

    public $due_id;
    public $due_category_id;
    public $amount;
    public $paid_amount;
    public $discount;
    public $note;

    protected $listeners = [
        'openEditDueModal' => 'openModal',
        'closeEditDueModal' => 'closeModal',
    ];

    protected $rules = [
        'note' => 'required|array',
    ];

    public function mount()
    {
        $this->dues_categories = DueCategory::all();
    }

    public function openModal($due_id)
    {
        $due = Due::findOrFail($due_id);

        $this->due_id = $due_id;
        $this->due_category_id = $due->due_category_id;
        $this->amount = $due->amount;
        $this->paid_amount = $due->paid_amount;
        $this->discount = $due->discount;
        $this->note['en'] = $due->getTranslation('note', 'en');
        $this->note['ar'] = $due->getTranslation('note', 'ar');
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->resetValidation();
        $this->reset(["amount", "paid_amount", "discount", "note", "due_category_id",]);
    }

    public function storeDue()
    {
        $this->validate([
            "amount" => "required|numeric|min:0.1",
            "paid_amount" => "required|numeric",
            "discount" => "required|numeric",
            "note.*" => "nullable|max:255|string",
            "due_category_id" => "required|integer|exists:due_categories,id",
        ]);

        Due::findOrFail($this->due_id)->update([
            "amount" => $this->amount,
            "paid_amount" => $this->paid_amount,
            "discount" => $this->discount,
            "note" => [
                'en' => $this->note['en'] ?? null,
                'ar' => $this->note['ar'] ?? ($this->note['en'] ?? null),
            ],
            "due_category_id" => $this->due_category_id,
        ]);

        $this->closeModal();
        $this->emit("success", __('messages.due_updated'));
    }

    public function render()
    {
        return view('livewire-components.admin.dues.edit-due');
    }
}