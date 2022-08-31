<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Users') }} ({{ $users->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">
                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateUserModal')">
                        {{ __('app.Add') }}
                    </button>
                </div>

                <div class="relative mr-6 my-2">
                    <input type="text" class="bg-purple-white shadow rounded border-0 p-3 pr-12 outline-none focus:outline-none" placeholder="{{ __('app.Search') }}" wire:model.debounce.500ms="query">
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
                        <th class="py-3 px-6 text-center">{{ __('app.Created At') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $user->id }}</td>
                            <td class="py-3 px-6 text-center flex justify-center items-center">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="hover:underline">{{ $user->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="mailto:{{ $user->email }}" class="hover:underline">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="py-3 px-6 text-center">{{ formatDateTime($user->created_at) }}</td>

                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditUserModal', {{ $user->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    @if (auth()->id() !== $user->id)
                                        <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteUser({{ $user->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
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
            {{ $users->links() }}
        </div>

        <livewire:admin.users.create-user></livewire:admin.users.create-user>

        <livewire:admin.users.edit-user></livewire:admin.users.edit-user>

        @push('scripts')
            <script>
                const deleteUser = (userId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('deleteUser', userId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
