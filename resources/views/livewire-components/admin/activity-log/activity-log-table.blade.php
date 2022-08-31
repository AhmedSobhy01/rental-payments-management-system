<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Activity Log') }} ({{ $logs->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">
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
                        <th class="py-3 px-6 text-center">{{ __('app.Agent') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.IP Address') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Searched For Tenant') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.User') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($logs as $log)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $loop->iteration + $logs->firstItem() - 1 }}</td>
                            <td class="py-3 px-6 text-center">{{ $log->agent }}</td>
                            <td class="py-3 px-6 text-center">{{ $log->ip }}</td>
                            <td class="py-3 px-6 text-center">
                                @if ($log->tenant)
                                    <a href="{{ route('admin.tenants.show', $log->tenant->id) }}" class="hover:underline">{{ $log->tenant->name }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if ($log->user)
                                    <a href="{{ route('admin.users.show', $log->user->id) }}" class="hover:underline">{{ $log->user->name }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteLog({{ $log->id }})">
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
            {{ $logs->links() }}
        </div>

        @push('scripts')
            <script>
                const deleteLog = (logId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyLog', logId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
