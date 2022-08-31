<div>
    <div class="flex flex-col justify-center items-center md:px-4">
        <div class="bg-white w-full rounded-lg shadow-xl">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <span>{{ __('app.Due Information') }}</span>
                </h2>
                <div>
                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditDueModal', {{ $due->id }})">
                        <i class="fas fa-pen"></i>
                    </button>

                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteDue()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Clinet Name') }}
                    </p>
                    <p>
                        <a class="hover:underline" href="{{ route('admin.tenants.show', $due->tenant->id) }}">{{ $due->tenant->name }}</a>
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Status') }}
                    </p>
                    <p>
                        <span class="px-4 py-1 text-center inline-flex leading-5 font-semibold rounded-full text-white {{ $due->status ? 'bg-green-600' : 'bg-red-600' }}"><span class="font-bold">{{ $due->status ? __('app.Paid') : __('app.Unpaid') }}</span>
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Category') }}
                    </p>
                    <p>
                        {{ $due->category->name }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Note') }}
                    </p>
                    <p>
                        {{ !empty($due->note) ? $due->note : '-' }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Created At') }}
                    </p>
                    <p>
                        {{ formatDateTime($due->created_at) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white w-full rounded-lg shadow-xl mt-5">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <span>{{ __('app.Due Payment Information') }}</span>
                </h2>
                <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-gray-600 hover:bg-gray-800 active:bg-gray-900 focus:outline-none border-4 border-white focus:border-gray-200 transition-all" onclick="toggleDueStatus({{ $due->id }})">{{ $due->status ? __('app.Mark As Unpaid') : __('app.Mark As Paid') }}</button>
            </div>
            <div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Amount') }}
                    </p>
                    <p>
                        {{ formatCurrency($due->amount) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Discount') }}
                    </p>
                    <p>
                        {{ formatCurrency($due->discount) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Amount After Discount') }}
                    </p>
                    <p>
                        {{ formatCurrency($due->amount_with_discount) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Paid Amount') }}
                    </p>
                    <p>
                        {{ formatCurrency($due->paid_amount) }}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        {{ __('app.Amount Left') }}
                    </p>
                    <p>
                        {{ formatCurrency($due->amount_left) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white w-full rounded-lg shadow-xl mt-5" x-data="{imgSrc: '', imgViewer: false}">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <span>{{ __('app.Attachments') }}</span>
                </h2>
                <div class="flex flex-col items-end">
                    <label class="w-4 mr-2 transform hover:text-indigo-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" for="add-attachment" wire:target="attachment" wire:loading.class="cursor-not-allowed"  wire:loading.class.remove="hover:text-indigo-500">
                        <span wire:target="attachment" wire:loading.remove><i class="fas fa-plus"></i></span>
                        <span wire:target="attachment" wire:loading><i class="fas fa-spinner animate-spin"></i></span>
                        <input type="file" id="add-attachment" class="hidden" wire:model="attachment" wire:loading.attr="disabled">
                    </label>
                    @error('attachment') <div class="text-red-600 text-sm" wire:target="attachment" wire:loading.remove>{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="p-4 flex justify-center items-center flex-wrap" id="attachments">
                @forelse ($due->attachments as $attachment)
                <div class="bg-gray-900 shadow-lg rounded p-3 mt-3 mr-3">
                    <div class="group relative h-72 md:w-64 flex items-center justify-center">
                        <img class="w-full h-full md:w-72 block rounded object-cover" src="{{ asset('storage/' . $attachment) }}" />
                        <div class="absolute bg-black rounded bg-opacity-0 group-hover:bg-opacity-60 w-full h-full top-0 flex items-center group-hover:opacity-100 transition justify-evenly">
                            <button class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition" @click="imgSrc = '{{ asset('storage/' . $attachment) }}'; imgViewer = true;">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition" onclick="deleteAttachment('{{ $attachment }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="font-bold text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg">{{ __('app.Nothing found') }}</div>
                @endforelse
            </div>

            <div x-show="imgViewer" class="fixed z-index-100 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-90">
                <span @click="imgViewer = false" class="block text-white pt-5 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'pl-5' : 'pr-5' }} cursor-pointer">
                    <i class="fas fa-times fa-lg"></i>
                </span>
                <div class="flex justify-center items-center h-full w-full -mt-10">
                    <img class="modal-content m-auto block w-10/12 max-w-md" id="full-image" @click.away="imgViewer = false" :src="imgSrc">
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.dues.edit-due')

    @push('scripts')
        <script>
            const deleteDue = () => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('destroyDue'),
                });
            };

            const toggleDueStatus = ($due) => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('toggleDueStatus', $due),
                });
            };

            const deleteAttachment = (attachment) => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('deleteAttachment', attachment),
                });
            };
        </script>
    @endpush
</div>
