<div>

    <div class="p-4 flex justify-center items-center dark:text-white ">
        <h2 class="text-4xl">{{ __('app.Unpaid Dues') }} ({{ $dues->total() }})</h2>
        <button class="text-3xl bg-blue-500 text-white px-4 py-1 rounded-full mx-3 hover:bg-blue-600 transition duration-200 each-in-out ml-5 outline-none focus:outline-none" onclick="Livewire.emit('openCreateDueModal')">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <div class="overflow-x-auto">
            <table class="min-w-max w-full table-auto overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">{{ __('app.ID') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Tenant') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Category') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Amount Left') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Amount') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Discount') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Amount After Discount') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Paid Amount') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Created At') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($dues as $due)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $due->id }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('admin.tenants.show', $due->tenant->id) }}" class="hover:underline">{{ $due->tenant->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">{{ $due->category->name }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($due->amount_left) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($due->amount) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($due->discount) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($due->amount_with_discount) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatCurrency($due->paid_amount) }}</td>
                            <td class="py-3 px-6 text-center">{{ formatDateTime($due->created_at) }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.dues.show', $due->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditDueModal', {{ $due->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteDue({{ $due->id }})">
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
            {{ $dues->links() }}
        </div>

        @livewire('admin.dues.create-due')
        @livewire('admin.dues.edit-due')

        @push('scripts')
            <script>
                const deleteDue = (dueId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyDue', dueId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
