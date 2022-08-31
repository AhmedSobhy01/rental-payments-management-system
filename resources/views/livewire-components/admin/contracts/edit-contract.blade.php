<div>
    @if ($open)

    <div class="hidden justify-center items-center w-full h-full fixed top-0 left-0 bg-black opacity-75 z-50"  wire:loading.class="flex" wire:loading.class.remove="hidden">
        <span class="text-white">
            <i class="fas fa-circle-notch fa-spin fa-5x"></i>
        </span>
    </div>


    <div class="bg-transparent z-40 relative w-screen h-screen" @keydown.enter.document.prevent="$refs.submit.click()">
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto p-7">
            <div class="relative sm:w-3/4 md:w-2/3 lg:w-1/2 mx-2 sm:mx-auto my-10 opacity-100 bg-white" @mousedown.away="@this.call('closeModal')">
                <div class="flex flex-col items-start w-full">
                    <div class="pt-7 pb-4 flex items-center w-full border border-b-3">
                        <div class="title text-gray-900 font-bold text-3xl text-center w-full">
                            {{ __('app.Edit Contract') }}
                        </div>
                        <svg wire:click="closeModal" class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-auto mr-6' : 'mr-auto ml-6' }} fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    <div class="body px-7 pt-3 pb-7 overflow-hidden w-full">
                        <div class="flex flex-col mb-4">
                            <label for="start_date" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Start Date') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="start_date" type="date" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="start_date">
                            @error("start_date") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="duration" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Duration') . " (" . __('app.Years') . ")" }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="duration" type="number" min="0" step="0.5" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="duration">
                            @error("duration") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="rent_amount" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Rent Amount') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="rent_amount" type="number" min="0.01" step="0.01" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="rent_amount">
                            @error("rent_amount") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="building_id" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Building') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative inline-flex">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full" wire:model="building_id" id="building_id">
                                    <option value="" selected class="text-grey-600">{{ __('app.Choose Building') }}</option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building->id }}" class="text-grey-600">{{ $building->address }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("building_id") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        @if ($building_id)
                        <div class="flex flex-col mb-4">
                            <label for="floor" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Floor') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative inline-flex">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full" wire:model="floor_no" id="floor">
                                    <option value="" selected class="text-grey-600">{{ __('app.Choose Floor') }}</option>
                                    @foreach ($floors as $floor)
                                        <option value="{{ $floor }}" class="text-grey-600">{{ $floor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("floor_no") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        @if ($floor_no)
                        <div class="flex flex-col mb-4">
                            <label for="apartment_id" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Apartment Number') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative inline-flex">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full" wire:model.defer="apartment_id" id="apartment_id">
                                    <option value="" selected class="text-grey-600">{{ __('app.Choose Apartment') }}</option>
                                    @foreach ($apartments as $apartment)
                                        <option value="{{ $apartment->id }}" class="text-grey-600">{{ $apartment->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("apartment_id") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        @endif

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
