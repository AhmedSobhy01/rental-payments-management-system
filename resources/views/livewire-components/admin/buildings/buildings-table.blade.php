<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Buildings') }} ({{ $buildings->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">

                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateBuildingModal')">
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
                        <th class="py-3 px-6 text-center">{{ __('app.Address') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Building Number') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Floors') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Apartments On Floor') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Total Apartments') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Has Basement') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Created At') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($buildings as $building)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $building->id }}</td>
                            <td class="py-3 px-6 text-center">{{ $building->address }}</td>
                            <td class="py-3 px-6 text-center">{{ $building->number }}</td>
                            <td class="py-3 px-6 text-center">{{ $building->apartments_max_floor }}</td>
                            <td class="py-3 px-6 text-center">{{ $building->apartments_count / $building->apartments_max_floor }}</td>
                            <td class="py-3 px-6 text-center">{{ $building->apartments_count }}</td>
                            <td class="py-3 px-6 text-center">
                                @if ($building->apartments->where('floor', 0)->count())
                                    <i class="fas fa-check fa-lg text-green-600"></i>
                                @else
                                    <i class="fas fa-times fa-lg text-red-600"></i>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">{{ $building->created_at }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.buildings.show', $building->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditBuildingModal', {{ $building->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteBuilding({{ $building->id }})">
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
            {{ $buildings->links() }}
        </div>

        @livewire('admin.buildings.create-building')
        @livewire('admin.buildings.edit-building')

        @push('scripts')
            <script>
                const deleteBuilding = (buildingId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyBuilding', buildingId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
