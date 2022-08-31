<div>

    <div class="text-4xl font-bold text-center dark:text-white">{{ __('app.Due Categories') }} ({{ $due_categories->total() }})</div>

    <div class="bg-white shadow-md rounded my-6">
        @if ($header)
            <div class="flex items-center justify-between">

                <div class="py-5 px-2">
                    <button class="bg-indigo-800 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-900 outline-none focus:outline-none" onclick="Livewire.emit('openCreateDueCategoryModal')">
                        {{ __('app.Add') }}
                    </button>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-max w-full table-auto overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">{{ __('app.Order') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.English Name') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Arabic Name') }}</th>
                        <th class="py-3 px-6 text-center">{{ __('app.Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light" wire:sortable="updateDuecategoryOrder">
                    @forelse ($due_categories as $due_category)
                        <tr class="border-b border-gray-200 hover:bg-gray-100" wire:sortable.item="{{ $due_category->id }}" wire:key="due-category-{{ $due_category->id }}">
                            <td class="py-3 px-6 text-center cursor-move" wire:sortable.handle>{{ $due_category->order }}</td>
                            <td class="py-3 px-6 text-center cursor-move" wire:sortable.handle>{{ $due_category->getTranslation('name', 'en') }}</td>
                            <td class="py-3 px-6 text-center cursor-move" wire:sortable.handle>{{ $due_category->getTranslation('name', 'ar') }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditDueCategoryModal', {{ $due_category->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteDueCategory({{ $due_category->id }})">
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
            {{ $due_categories->links() }}
        </div>

        <livewire:admin.due-categories.create-due-category></livewire:admin.due-categories.create-due-category>

        <livewire:admin.due-categories.edit-due-category></livewire:admin.due-categories.edit-due-category>

        @push('scripts')
            <script>
                const deleteDueCategory = (dueCategoryId) => {
                    Swal.fire({
                        title: "{{ __('app.Are you sure?') }}",
                        text: "{!! __('app.You wont be able to revert this!') !!}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonText: "{{ __('app.Cancel') }}",
                            confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                        showLoaderOnConfirm: true,
                        preConfirm: () => @this.call('destroyDueCategory', dueCategoryId),
                    })
                };
            </script>
        @endpush
    </div>
</div>
