<div>
    <div class="flex flex-col justify-center items-center md:px-4">
        <div class="bg-white w-full rounded-lg shadow-xl mt-5">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <span>{{ __('app.Building Information') }}</span>
                </h2>
                <div>
                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditBuildingModal', {{ $building->id }})">
                        <i class="fas fa-pen"></i>
                    </button>

                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteBuilding()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.English Address') }}
                    </p>
                    <p>
                        {{ $building->getTranslation('address', 'en') }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Arabic Address') }}
                    </p>
                    <p>
                        {{ $building->getTranslation('address', 'ar') }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Floors') }}
                    </p>
                    <p>
                        {{ $building->apartments_max_floor }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Apartments On Floor') }}
                    </p>
                    <p>
                        {{ $building->apartments_count / $building->apartments_max_floor }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Total Apartments') }}
                    </p>
                    <p>
                        {{ $building->apartments_count }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Has Basement?') }}
                    </p>
                    <p>
                        @if ($building->apartments->where('floor', 0)->count())
                            <i class="fas fa-check fa-lg text-green-600"></i>
                        @else
                            <i class="fas fa-times fa-lg text-red-600"></i>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white w-full rounded-lg shadow-xl mt-5">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl">
                    {{ __('app.Contracts') }} ({{ $building->contracts->count() }})
                </h2>
            </div>
            <div class="p-4">
                @forelse ($building->contracts as $contract)
                    <a href="{{ route('admin.contracts.show', $contract->id) }}" class="my-5 w-full block">
                        <div class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out">
                            <h3 class="font-semibold text-lg tracking-wide flex items-center">
                                <span>{{ formatDate($contract->start_date) }} - {{ formatDate($contract->end_date) }}</span>
                                <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white {{ now() > $contract->end_date ? 'bg-red-600' : 'bg-green-600' }}">{!! now() > $contract->end_date ? '<span class="font-bold">' . __('app.Ended') . '</span>' : dateDiff(now(), $contract->end_date) !!}</span>
                            </h3>
                            <div class="mt-3 mx-3">
                                <p class="text-gray-500 my-1">
                                    <span class="font-bold">{{ __('app.Rent Amount') }}:</span> {{ formatCurrency($contract->rent_amount) }}
                                </p>
                                <p class="text-gray-500 my-1">
                                    <span class="font-bold">{{ __('app.Duration') }}:</span> {{ $contract->duration . " " . __('app.years') }}
                                </p>
                                <p class="text-gray-500 my-1">
                                    <span class="font-bold">{{ __('app.Attachments') }}:</span> {{ count($contract->attachments) }}
                                </p>

                                <br>

                                <p class="text-gray-500 my-1">
                                    <span class="font-bold">{{ __('app.Floor') }}:</span> {{ $contract->apartment->floor }}
                                </p>
                                <p class="text-gray-500 my-1">
                                    <span class="font-bold">{{ __('app.Apartment Number') }}:</span> {{ $contract->apartment->number }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="font-bold text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg">{{ __('app.Nothing found') }}</div>
                @endforelse
            </div>
        </div>
    </div>

    @livewire('admin.buildings.edit-building')

    @push('scripts')
        <script>
            const deleteBuilding = () => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('destroyBuilding'),
                });
            };
        </script>
    @endpush
</div>
