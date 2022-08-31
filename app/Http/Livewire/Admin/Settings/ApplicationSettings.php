<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Resource;
use Illuminate\Support\Facades\Artisan;

class ApplicationSettings extends Component
{
    public $pagination_count;

    public $currency_name_en;
    public $currency_symbol_en;

    public $currency_name_ar;
    public $currency_symbol_ar;

    protected $listeners = [
        'success' => '$refresh',
        'error' => '$refresh',
    ];

    public function mount()
    {
        $this->pagination_count = config('custom.pagination_count');

        $this->currency_name_en = config('custom.currency_name_en');
        $this->currency_symbol_en = config('custom.currency_symbol_en');

        $this->currency_name_ar = config('custom.currency_name_ar');
        $this->currency_symbol_ar = config('custom.currency_symbol_ar');
    }

    public function updatePaginationCount()
    {
        $this->validate([
            "pagination_count" => 'required|integer|min:2|max:100',
        ]);

        updateDotEnv('PAGINATION_COUNT', $this->pagination_count);

        $this->emit("success", __('messages.settings_updated'));
    }

    public function updateEnglishCurrency()
    {
        $this->validate([
            "currency_name_en" => 'required|string|max:100',
            "currency_symbol_en" => 'required|string|max:100',
        ]);

        updateDotEnv('CURRENCY_NAME_EN', $this->currency_name_en, '"');
        updateDotEnv('CURRENCY_SYMBOL_EN', $this->currency_symbol_en, '"');

        $this->emit("success", __('messages.settings_updated'));
    }

    public function updateArabicCurrency()
    {
        $this->validate([
            "currency_name_ar" => 'required|string|max:100',
            "currency_symbol_ar" => 'required|string|max:100',
        ]);

        updateDotEnv('CURRENCY_NAME_AR', $this->currency_name_ar, '"');
        updateDotEnv('CURRENCY_SYMBOL_AR', $this->currency_symbol_ar, '"');

        $this->emit("success", __('messages.settings_updated'));
    }

    public function clearCache() {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            $this->emit('success', __('messages.cache_cleared'));
        } catch (\Exception $e){
            $this->emit('success', __('messages.error'));
        }
    }

    public function render()
    {
        return view('livewire-components.admin.settings.application-settings');
    }
}