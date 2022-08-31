<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Nationalities') }} ({{ $nationalities->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">

                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateNationalityModal')">
                        {{ __('app.Add') }}
                    </button>
                </div>

                <div class="relative mx-6 my-2 overflow-hidden">
                    <input type="text" class="bg-purple-white shadow rounded border-0 p-3 pr-12 w-full outline-none focus:outline-none" placeholder="{{ __('app.Search') }}" wire:model.debounce.500ms="query">
                    <div class="absolute top-0 right-0 mt-3 mr-4 text-purple-lighter" wire:target="query" wire:loading.remove>
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="absolute top-0 right-0 mt-3 mr-4 text-purple-lighter" wire:target="query" wire:loading>
                        <i class="fas fa-spinner animate-spin"></i>
                    </div>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-max w-full table-auto overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">{{ __('app.ID') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Code') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.English Name') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Arabic Name') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($nationalities as $nationality)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $nationality->id }}</td>
                            <td class="py-3 px-6 text-center">{{ $nationality->code }}</td>
                            <td class="py-3 px-6 text-center">{{ $nationality->getTranslation('name', 'en') }}</td>
                            <td class="py-3 px-6 text-center">{{ $nationality->getTranslation('name', 'ar') }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditNationalityModal', {{ $nationality->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteNationality({{ $nationality->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="py-3 px-6 text-center text-lg" colspan="20">{{ __('app.Nothing found') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-5">
            {{ $nationalities->links() }}
        </div>

        <livewire:admin.nationalities.create-nationality></livewire:admin.nationalities.create-nationality>

        <livewire:admin.nationalities.edit-nationality></livewire:admin.nationalities.edit-nationality>

        @push('scripts')
            <script>
                const deleteNationality = (nationalityId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyNationality', nationalityId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
