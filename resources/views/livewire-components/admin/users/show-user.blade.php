<div>
    <div class="flex flex-col justify-center items-center md:px-4 text-gray-600">
        <div class="max-w-4xl bg-white w-full rounded-lg shadow-xl">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <span>{{ __('app.User Information') }}</span>
                </h2>
                <div>
                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditUserModal', {{ $user->id }})">
                        <i class="fas fa-pen"></i>
                    </button>

                    @if (auth()->id() !== $user->id)
                        <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteUser()">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
            </div>
            <div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.English Name') }}
                    </p>
                    <p>
                        {{ $user->getTranslation('name', 'en') }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Arabic Name') }}
                    </p>
                    <p>
                        {{ $user->getTranslation('name', 'ar') }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Email Address') }}
                    </p>
                    <a href="mailto:{{ $user->email }}" class="hover:underline">
                        {{ $user->email }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <livewire:admin.users.edit-user></livewire:admin.users.edit-user>

    @push('scripts')
        <script>
            const deleteUser = () => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('destroyUser'),
                });
            };
        </script>
    @endpush
</div>
