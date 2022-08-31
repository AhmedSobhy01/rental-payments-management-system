<div>
    @if ($open)

    <div class="bg-transparent z-40 relative w-screen h-screen" @keydown.enter.document.prevent="$refs.submit.click()">
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto p-7">
            <div class="relative sm:w-3/4 md:w-2/3 lg:w-1/2 mx-2 sm:mx-auto my-10 opacity-100 bg-white" @mousedown.away="@this.call('closeModal')">
                <div class="flex flex-col items-start w-full">
                    <div class="pt-7 pb-4 flex items-center w-full border border-b-3">
                        <div class="title text-gray-900 font-bold text-3xl text-center w-full">
                            {{ __('app.Edit Due') }}
                        </div>
                        <svg wire:click="closeModal" class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-auto mr-6' : 'mr-auto ml-6' }} fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    <div class="body px-7 pt-3 pb-7 overflow-hidden w-full">
                        <div class="flex flex-col mb-4">
                            <label for="amount" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Amount') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="amount" type="number" min="0.01" step="0.01" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="amount">
                            @error("amount") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="discount" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Discount') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="discount" type="number" min="0.01" step="0.01" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="discount">
                            @error("discount") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="paid_amount" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Paid Amount') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="paid_amount" type="number" min="0.01" step="0.01" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="paid_amount">
                            @error("paid_amount") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="due_category" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Category') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative inline-flex">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full" wire:model.defer="due_category_id" id="due_category">
                                    <option value="" selected class="text-grey-600">{{ __('app.Choose Category') }}</option>
                                    @foreach ($dues_categories as $category)
                                        <option value="{{ $category->id }}" class="text-grey-600">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("due_category_id") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="note_en" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.English Note') }}
                            </label>
                            <input id="note_en" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="note.en">
                            @error("note") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                            @error("note.en") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="note_ar" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Arabic Note') }}
                            </label>
                            <input id="note_ar" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="note.ar">
                            @error("note.ar") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="border-t border-gray-200">
                            <button class="text-sm mt-4 uppercase px-8 py-2 rounded bg-indigo-500 text-blue-50 w-full shadow-sm hover:shadow-lg transition-all duration-200" wire:click="storeDue" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" x-ref="submit">{{ __('app.Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
