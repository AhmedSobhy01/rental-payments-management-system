<?php

namespace App\Http\Livewire\Admin\Dues;

use App\Models\Due;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ShowDue extends Component
{
    use WithFileUploads;

    public $due_id;
    public $due;

    public $attachment;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->due_id = request()->due;
    }

    public function hydrate()
    {
        LaravelLocalization::setLocale(session('locale'));
    }

    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'image|max:3072',
        ]);

        $this->attachment->store('public/dues/' . $this->due_id);
        $this->emit('success', __('messages.attachment_uploaded'));
    }

    public function deleteAttachment($attachment)
    {
        File::delete(storage_path('app/public/' . $attachment));

        $this->emit('success', __('messages.attachment_deleted'));
    }

    public function toggleDueStatus()
    {
        $due = Due::find($this->due_id);

        if (!$due) return $this->emit('error', __('messages.due_not_found'));

        $due->paid_amount = $due->amount_left > 0 ? $due->amount - $due->discount : 0;
        $due->save();

        $this->emit('success', $due->paid ? __('messages.due_marked_paid') : __('messages.due_marked_unpaid'));
    }

    public function destroyDue()
    {
        $due = Due::find($this->due_id);

        if (!$due) return $this->emit('error', __('messages.due_not_found'));

        $due->delete();

        $this->emit('success', __('messages.due_deleted'));
    }

    public function render()
    {
        $this->due = Due::with(["tenant",])
                        ->findOrFail($this->due_id);

        return view('livewire-components.admin.dues.show-due');
    }
}