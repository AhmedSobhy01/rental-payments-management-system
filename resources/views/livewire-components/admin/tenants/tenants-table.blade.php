<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Tenants') }} ({{ $tenants->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">

                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateTenantModal')">
                        {{ __('app.Add') }}
                    </button>
                </div>

                <div class="py-5 px-2">
                    <button class="bg-red-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-red-100 rounded-full hover:shadow-lg hover:bg-red-900 outline-none focus:outline-none ml-5" onclick="addMonthlyRentDue()">
                        {{ __('app.Add Monthly Rent Due') }}
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
                        <th class="py-3 px-6 text-center">{{ __('app.Name') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Email Address') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Phone Number') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Birthday') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Nationality') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.National Card No') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Passport No') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Marital Status') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Unpaid Dues Count') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Unpaid Dues Amount') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Created At') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($tenants as $tenant)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $tenant->id }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('admin.tenants.show', $tenant->id) }}" class="hover:underline">{{ $tenant->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if ($tenant->email)
                                    <a href="mailto:{{ $tenant->email }}" class="hover:underline">{{ $tenant->email ?? '-' }}</a>
                                @else
                                    {{ $tenant->email ?? '-' }}
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if ($tenant->phone)
                                    <a href="tel:{{ $tenant->phone }}" class="hover:underline">{{ $tenant->phone ?? '-' }}</a>
                                @else
                                    {{ $tenant->phone ?? '-' }}
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">{{ $tenant->birthday }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->nationality->name }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->national_card_no ?? '-' }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->passport_no ?? '-' }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->married ? __('app.Married') : __('app.Not Married') }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->dues_count }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($tenant->total_unpaid_dues_amount) }}</td>
                            <td class="py-3 px-6 text-center">{{ $tenant->created_at }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.tenants.show', $tenant->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditTenantModal', {{ $tenant->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteTenant({{ $tenant->id }})">
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
            {{ $tenants->links() }}
        </div>

        @livewire('admin.tenants.create-tenant')
        @livewire('admin.tenants.edit-tenant')

        @push('scripts')
            <script>
                const addMonthlyRentDue = () => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You will add a monthly rent due for all tenants for current month!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('addMonthlyRentDue'),
                    })
                };

                const deleteTenant = (tenantId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyTenant', tenantId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
