<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Recently Expired Contracts') }} ({{ $contracts->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        <div class="overflow-x-auto">
            <table class="min-w-max w-full table-auto overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">{{ __('app.ID') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Tenant') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Start Date') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.End Date') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Duration') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Address') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($contracts as $contract)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $contract->id }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('admin.tenants.show', $contract->tenant->id) }}" class="hover:underline">{{ $contract->tenant->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">{{ formatDateTime($contract->start_date) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatDateTime($contract->end_date) }}</td>
                            <td class="py-3 px-6 text-center">{{ $contract->duration . ' ' . __('app.years') }}</td>
                            <td class="py-3 px-6 text-center">{{ $contract->apartment->building->address }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.contracts.show', $contract->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditContractModal', {{ $contract->id }})">
                                        <i class="fas fa-pen"></i>
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
            {{ $contracts->links() }}
        </div>

        @livewire('admin.contracts.edit-contract')
    </div>
</div>
