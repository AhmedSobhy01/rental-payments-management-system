<div>
    <div class="grid bg-white rounded-lg shadow-xl w-11/12 py-5 mx-auto text-gray-600">
        <div class="flex justify-center">
            <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">{{ __('app.Edit Account') }}</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-600 font-semibold">
                    {{ __('app.English Name') }}
                    <span class="text-red-600 font-bold ml-1">*</span>
                </label>
                <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" name="name[en]" placeholder="{{ __('app.English Name') }}" wire:model.defer="name.en" />
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                @error('name.en') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-600 font-semibold">
                    {{ __('app.Arabic Name') }}
                </label>
                <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" name="name[ar]" placeholder="{{ __('app.Arabic Name') }}" wire:model.defer="name.ar" />
                @error('name.ar') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-600 font-semibold">
                {{ __('app.Email Address') }}
                <span class="text-red-600 font-bold ml-1">*</span>
            </label>
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" name="email" placeholder="{{ __('app.Email Address') }}" wire:model.defer="email" />
            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-600 font-semibold">
                {{ __('app.Password') }}
            </label>
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" name="password" placeholder="{{ __('app.Password') }} ({{ __('app.Leave Blank For No Change') }})"  wire:model.defer="password" />
            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-600 font-semibold">
                {{ __('app.Confirm Password') }}
            </label>
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" name="password_confirmation" placeholder="{{ __('app.Confirm Password') }}"  wire:model.defer="password_confirmation" />
        </div>

        <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
            <button class="w-full mx-6 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2" type="button" wire:click="updateAccount" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50">{{ __('app.Save') }}</button>
        </div>
    </div>
</div>
