<?php

namespace App\Http\Livewire\Admin\Contracts;

use App\Models\Contract;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowContract extends Component
{
    use WithFileUploads;

    public $contract_id;
    public $contract;

    public $attachment;

    public $due_categories;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->contract_id = request()->contract;
    }

    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'image|max:3072',
        ]);

        $this->attachment->store('public/contracts/' . $this->contract_id);
        $this->emit('success', __('messages.attachment_uploaded'));
    }

    public function deleteAttachment($attachment)
    {
        File::delete(storage_path('app/public/' . $attachment));

        $this->emit('success', __('messages.attachment_deleted'));
    }

    public function destroyContract()
    {
        $contract = Contract::findOrFail($this->contract_id);

        $tenant_id = $contract->tenant_id;

        $contract->delete();

        session()->flash("success", __('messages.contract_deleted'));

        redirect()->route('admin.tenants.show', $tenant_id);
    }

    public function render()
    {
        $this->contract = Contract::with([
                            "tenant",
                        ])
                        ->findOrFail($this->contract_id);

        return view('livewire-components.admin.contracts.show-contract');
    }
}