<div>
    @if ($open)

    <div class="bg-transparent z-40 relative w-screen h-screen" @keydown.enter.document.prevent="$refs.submit.click()">
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto p-7">
            <div class="relative sm:w-3/4 md:w-2/3 lg:w-1/2 mx-2 sm:mx-auto my-10 opacity-100 bg-white" @mousedown.away="@this.call('closeModal')">
                <div class="flex flex-col items-start w-full">
                    <div class="pt-7 pb-4 flex items-center w-full border border-b-3">
                        <div class="title text-gray-900 font-bold text-3xl text-center w-full">
                            {{ __('app.Create Building') }}
                        </div>
                        <svg wire:click="closeModal" class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-auto mr-6' : 'mr-auto ml-6' }} fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    <div class="body px-7 pt-3 pb-7 overflow-hidden w-full">
                        <div class="flex flex-col mb-4">
                            <label for="address_en" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.English Address') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="address_en" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="address.en">
                            @error("address.en") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="address_ar" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Arabic Address') }}
                            </label>
                            <input id="address_ar" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="address.ar">
                            @error("address.ar") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="number" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Building Number') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="number" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="number">
                            @error("number") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="floors" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Floors') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="floors" type="number" min="1" step="1" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="floors">
                            @error("floors") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="apartments_on_floor" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Apartments On Floor') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="apartments_on_floor" type="number" min="1" step="1" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="apartments_on_floor">
                            @error("apartments_on_floor") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" wire:model.defer="basement"><span class="ml-2 text-gray-700">{{ __('app.Has Basement?') }}</span>
                            </label>
                            @error("basement") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="border-t border-gray-200">
                            <button class="text-sm mt-4 uppercase px-8 py-2 rounded bg-indigo-500 text-blue-50 w-full shadow-sm hover:shadow-lg transition-all duration-200" wire:click="storeBuilding" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" x-ref="submit">{{ __('app.Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
