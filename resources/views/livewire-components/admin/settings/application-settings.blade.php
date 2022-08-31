<div>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <div class="text-2xl mb-5 border-b pb-3">{{ __('app.Application Settings') }}</div>
        <div class="-mx-3 md:flex" @keydown.enter="document.getElementById('application-settings-submit').click()">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker font-bold mb-2" for="pagination_count">
                    {{ __('app.Pagination Count') }}
                </label>
                <div class="flex items-center">
                    <input type="number" id="pagination_count" placeholder="{{ __('app.Pagination Count') }}" wire:model.defer="pagination_count" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                    <button class="flex {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-5' : 'mr-5' }} h-full px-6 py-2 text-xs font-medium leading-8 text-center text-white uppercase transition bg-blue-700 rounded shadow hover:shadow-lg hover:bg-blue-800 focus:outline-none" wire:click="updatePaginationCount" wire:target="updatePaginationCount" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" wire:loading.class.remove="hover:bg-blue-800" id="application-settings-submit">
                        <div class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'mr-2' : 'ml-2' }}" wire:target="updatePaginationCount" wire:loading>
                            <i class="fas fa-spinner animate-spin"></i>
                        </div>
                        <span>{{ __('app.Save') }}</span>
                    </button>
                </div>
                @error("pagination_count") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="-mx-3 md:flex mt-5" @keydown.enter="document.getElementById('currency-en-settings-submit').click()">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker font-bold mb-2" for="currency_name">
                    {{ __('app.Currency In English') }}
                </label>
                <div class="flex items-center">
                    <input type="text" id="currency_name_en" placeholder="{{ __('app.Currency Name In English') }}" wire:model.defer="currency_name_en" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'mr-2' : 'ml-2' }}">
                    <input type="text" id="currency_symbol_en" placeholder="{{ __('app.Currency Symbol In English') }}" wire:model.defer="currency_symbol_en" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                    <button class="flex {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-5' : 'mr-5' }} h-full px-6 py-2 text-xs font-medium leading-8 text-center text-white uppercase transition bg-blue-700 rounded shadow hover:shadow-lg hover:bg-blue-800 focus:outline-none" wire:click="updateEnglishCurrency" wire:target="updateEnglishCurrency" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" wire:loading.class.remove="hover:bg-blue-800" id="currency-en-settings-submit">
                        <div class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'mr-2' : 'ml-2' }}" wire:target="updateEnglishCurrency" wire:loading>
                            <i class="fas fa-spinner animate-spin"></i>
                        </div>
                        <span>{{ __('app.Save') }}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="-mx-3 md:flex mt-5" @keydown.enter="document.getElementById('currency-ar-settings-submit').click()">
            <div class="md:w-full px-3">
                <label class="block uppercase tracking-wide text-grey-darker font-bold mb-2" for="currency_name">
                    {{ __('app.Currency In Arabic') }}
                </label>
                <div class="flex items-center">
                    <input type="text" id="currency_name_ar" placeholder="{{ __('app.Currency Name In Arabic') }}" wire:model.defer="currency_name_ar" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'mr-2' : 'ml-2' }}">
                    <input type="text" id="currency_symbol_ar" placeholder="{{ __('app.Currency Symbol In Arabic') }}" wire:model.defer="currency_symbol_ar" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4">
                    <button class="flex {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-5' : 'mr-5' }} h-full px-6 py-2 text-xs font-medium leading-8 text-center text-white uppercase transition bg-blue-700 rounded shadow hover:shadow-lg hover:bg-blue-800 focus:outline-none" wire:click="updateArabicCurrency" wire:target="updateArabicCurrency" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" wire:loading.class.remove="hover:bg-blue-800" id="currency-ar-settings-submit">
                        <div class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'mr-2' : 'ml-2' }}" wire:target="updateArabicCurrency" wire:loading>
                            <i class="fas fa-spinner animate-spin"></i>
                        </div>
                        <span>{{ __('app.Save') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="border border-red-600 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <div class="text-2xl mb-5 border-b pb-3">{{ __('app.Danger Zone') }}</div>
        <div class="py-3 flex justify-between items-center">
            <h3 class="block uppercase tracking-wide text-grey-darker font-bold mb- w-full">{{ __('app.Clear Cache') }}:</h3>
            <button class="flex justify-center items-center w-full border-2 border-red-600 text-red-600 rounded-lg px-3 py-2 hover:bg-red-600 hover:text-red-200 focus:outline-none transition" onclick="clearCache()">
                <span>{{ __('app.Clear') }}</span>
            </button>
        </div>
    </div>


    @push('scripts')
    <script>
        const clearCache = () => {
            Swal.fire({
                title: "{{ __('app.Are you sure?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: "{{ __('app.Cancel') }}",
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('app.Yes') }}",
                showLoaderOnConfirm: true,
                preConfirm: () => @this.call('clearCache'),
            })
        };
    </script>
@endpush
</div>
