<div>
    @if ($open)

    <div class="bg-transparent z-40 relative w-screen h-screen" @keydown.enter.document.prevent="document.getElementById('submit').click()">
        <div class="p-7 flex justify-center items-center fixed left-0 top-0 w-full h-full bg-gray-900 bg-opacity-50 z-50 transition-opacity duration-300">
            <div class="bg-white flex rounded-lg w-full md:w-1/2 relative mt-5" @mousedown.away="@this.call('closeModal')">
                <div class="flex flex-col items-start w-full max-h-screen">
                    <div class="pt-7 pb-4 flex items-center w-full border border-b-3">
                        <div class="title text-gray-900 font-bold text-3xl text-center w-full">
                            {{ __('app.Create User') }}
                        </div>
                        <svg wire:click="closeModal" class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-auto mr-6' : 'mr-auto ml-6' }} fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    <div class="body px-7 pt-3 pb-7 overflow-y-auto w-full text-gray-600" x-data="{showPwd: false}">
                        <div class="flex flex-col mb-4">
                            <label for="name_en" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.English Name') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="name_en" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="name.en">
                            @error("name") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                            @error("name.en") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name_ar" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Arabic Name') }}
                            </label>
                            <input id="name_ar" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="name.ar">
                            @error("name.ar") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Email Address') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="email" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="email">
                            @error("email") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Password') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative">
                                <input id="password" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" :type="showPwd ? 'text' : 'password'" wire:model.defer="password">
                                <div class="absolute top-5 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center text-sm leading-5">
                                    <i class="fas cursor-pointer" :class="{'fa-eye': !showPwd, 'fa-eye-slash': showPwd,}" @click="showPwd = !showPwd"></i>
                                </div>
                            </div>
                            @error("password") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="password_confirmation" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Confirm Password') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="password_confirmation" :type="showPwd ? 'text' : 'password'" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="password_confirmation">
                        </div>
                        <div class="border-t border-gray-200">
                            <button class="text-sm mt-4 uppercase px-8 py-2 rounded bg-indigo-500 text-blue-50 w-full shadow-sm hover:shadow-lg transition-all duration-200" wire:click="storeUser" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" id="submit">{{ __('app.Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
