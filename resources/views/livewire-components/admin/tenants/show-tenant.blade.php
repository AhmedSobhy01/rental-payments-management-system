<div>
    <div class="flex flex-col justify-center items-center md:px-4">
        <div class="md:flex md:items-start w-full">
            <div class="bg-white w-full rounded-lg shadow-xl">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-2xl flex items-center">
                        <span>{{ __('app.Tenant Information') }}</span>
                    </h2>
                    <div>
                        <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openEditTenantModal', {{ $tenant->id }})">
                            <i class="fas fa-pen"></i>
                        </button>

                        <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="deleteTenant()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.English Name') }}
                        </p>
                        <p>
                            {{ $tenant->getTranslation('name', 'en') }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Arabic Name') }}
                        </p>
                        <p>
                            {{ $tenant->getTranslation('name', 'ar') }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Email Address') }}
                        </p>
                        <p>
                            {{ $tenant->email ?? '-' }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Phone Number') }}
                        </p>
                        <p>
                            {{ $tenant->phone ?? '-' }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Birthday') }}
                        </p>
                        <p>
                            {{ $tenant->birthday }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Nationality') }}
                        </p>
                        <p>
                            {{ $tenant->nationality->name }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.National Card Number') }}
                        </p>
                        <p>
                            {{ $tenant->national_card_no ?? '-' }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Passport Number') }}
                        </p>
                        <p>
                            {{ $tenant->passport_no ?? '-' }}
                        </p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                        <p class="text-gray-600">
                            {{ __('app.Marital Status') }}
                        </p>
                        <p>
                            {{ $tenant->married ? __('app.Married') : __('app.Not Married') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white w-full rounded-lg shadow-xl mt-5 md:mt-0 {{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'md:ml-5' : 'md:mr-5' }}">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-2xl">
                        {{ __('app.Contracts') }} ({{ $tenant->contracts->count() }})
                    </h2>
                    <button class="w-4 mr-2 transform hover:text-indigo-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openCreateContractModal', {{ $tenant->id }})">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="p-4">
                    @forelse ($tenant->contracts as $contract)
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
                                        <span class="font-bold">{{ __('app.Address') }}:</span> {{ $contract->apartment->building->address }}
                                    </p>
                                    <p class="text-gray-500 my-1">
                                        <span class="font-bold">{{ __('app.Building Number') }}:</span> {{ $contract->apartment->building->number }}
                                    </p>
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

        <div class="bg-white w-full rounded-lg shadow-xl mt-5">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-2xl">
                    {{ __('app.Dues') }} ({{ $tenant->dues->count() }})
                </h2>
                <button class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110 cursor-pointer outline-none focus:outline-none" onclick="Livewire.emit('openCreateDueModal', {{ $tenant->id }})">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="mb-5 w-full">
                    <div class="w-full rounded-lg p-4 border border-gray-400">
                        <h3 class="tracking-wide flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold">{{ __('app.Summary') }}:</span>
                            </div>
                        </h3>
                        <div class="mt-3 mx-3 text-lg md:text-xl text-center">
                            <div class="flex items-center justify-evenly flex-col md:flex-row">
                                <div>
                                    <p class="text-gray-500 my-1">
                                        <span class="font-bold">{{ __('app.Total Unpaid Dues') }}:</span> {{ formatCurrency($tenant->total_unpaid_dues_amount) }}
                                    </p>
                                    <p class="text-gray-500 my-1">
                                        <span class="font-bold">{{ __('app.Total Paid Dues') }}:</span> {{ formatCurrency($tenant->total_paid_dues_amount) }}
                                    </p>
                                    <br>
                                </div>
                                <div>
                                    @foreach ($due_categories as $category)
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Unpaid Dues') . " (" . $category->name . ") " }}:</span> {{ formatCurrency($tenant->dues->filter(fn ($v) => ($v->amount_left > 0) && $v->due_category_id == $category->id)->sum('amount_left')) }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="font-bold text-2xl text-gray-600">{{ __('app.Unpaid Dues') }}:</div>
                    <div class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-3' : 'mr-3' }}">
                        @forelse ($tenant->dues->filter(fn ($v) => $v->amount_left > 0) as $due)
                            <div class="my-5 w-full">
                                <div class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <h3 class="font-semibold text-lg tracking-wide flex items-center justify-center flex-col md:flex-row md:justify-between">
                                        <a href="{{ route('admin.dues.show', $due->id) }}" class="flex items-center">
                                            <span class="text-xl font-bold hover:underline">{{ formatCurrency($due->amount_left) }}</span>
                                            <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white {{ $due->status ? 'bg-green-600' : 'bg-red-600' }}">{{ $due->status ? __('app.Paid') : __('app.Unpaid') }}</span>
                                        </a>
                                        <div class="my-3 md:mt-0 flex items-center">
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-gray-600 hover:bg-gray-800 active:bg-gray-900 focus:outline-none border-4 border-white focus:border-gray-200 transition-all" onclick="toggleDueStatus({{ $due->id }})">{{ $due->status ? __('app.Mark As Unpaid') : __('app.Mark As Paid') }}</button>
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-800 focus:outline-none border-4 border-white focus:border-yellow-200 transition-all" onclick="Livewire.emit('openEditDueModal', {{ $due->id }})">{{ __('app.Edit') }}</button>
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-red-600 hover:bg-red-800 focus:outline-none border-4 border-white focus:border-red-200 transition-all" onclick="deleteDue({{ $due->id }})">{{ __('app.Delete') }}</button>
                                        </div>
                                    </h3>
                                    <div class="mt-3 mx-3">
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount Left') }}:</span> {{ formatCurrency($due->amount_left) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Paid Amount') }}:</span> {{ formatCurrency($due->paid_amount) }}
                                        </p>

                                        <br>

                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount After Discount') }}:</span> {{ formatCurrency($due->amount_with_discount) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount') }}:</span> {{ formatCurrency($due->amount) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Discount') }}:</span> {{ formatCurrency($due->discount) }}
                                        </p>

                                        <br>

                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Category') }}:</span> {{ $due->category->name }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Note') }}:</span> {{ !empty($due->note) ? $due->note : '-' }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Attachments') }}:</span> {{ count($due->attachments) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Created At') }}:</span> {{ formatDateTime($due->created_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="font-bold mt-5 text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg">{{ __('app.Nothing found') }}</div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-10">
                    <div class="font-bold text-2xl text-gray-600">{{ __('app.Paid Dues') }}:</div>
                    <div class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-3' : 'mr-3' }}">
                        @forelse ($tenant->dues->filter(fn ($v) => $v->amount_left <= 0) as $due)
                            <div class="my-5 w-full">
                                <div class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <h3 class="font-semibold text-lg tracking-wide flex items-center justify-center flex-col md:flex-row md:justify-between">
                                        <a href="{{ route('admin.dues.show', $due->id) }}" class="flex items-center">
                                            <span class="text-xl font-bold hover:underline">{{ formatCurrency($due->amount_left) }}</span>
                                            <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white {{ $due->status ? 'bg-green-600' : 'bg-red-600' }}">{{ $due->status ? __('app.Paid') : __('app.Unpaid') }}</span>
                                        </a>
                                        <div class="my-3 md:mt-0 flex items-center">
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-gray-600 hover:bg-gray-800 active:bg-gray-900 focus:outline-none border-4 border-white focus:border-gray-200 transition-all" onclick="toggleDueStatus({{ $due->id }})">{{ $due->status ? __('app.Mark As Unpaid') : __('app.Mark As Paid') }}</button>
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-800 focus:outline-none border-4 border-white focus:border-yellow-200 transition-all" onclick="Livewire.emit('openEditDueModal', {{ $due->id }})">{{ __('app.Edit') }}</button>
                                            <button class="px-5 py-3 rounded-xl text-sm font-medium text-white bg-red-600 hover:bg-red-800 focus:outline-none border-4 border-white focus:border-red-200 transition-all" onclick="deleteDue({{ $due->id }})">{{ __('app.Delete') }}</button>
                                        </div>
                                    </h3>
                                    <div class="mt-3 mx-3">
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount Left') }}:</span> {{ formatCurrency($due->amount_left) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Paid Amount') }}:</span> {{ formatCurrency($due->paid_amount) }}
                                        </p>

                                        <br>

                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount After Discount') }}:</span> {{ formatCurrency($due->amount_with_discount) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Amount') }}:</span> {{ formatCurrency($due->amount) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Discount') }}:</span> {{ formatCurrency($due->discount) }}
                                        </p>

                                        <br>

                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Category') }}:</span> {{ $due->category->name }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Note') }}:</span> {{ !empty($due->note) ? $due->note : '-' }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Attachments') }}:</span> {{ count($due->attachments) }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">{{ __('app.Created At') }}:</span> {{ formatDateTime($due->created_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="font-bold mt-5 text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg">{{ __('app.Nothing found') }}</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.tenants.edit-tenant')

    @livewire('admin.contracts.create-contract')

    @livewire('admin.dues.create-due')
    @livewire('admin.dues.edit-due')

    @push('scripts')
        <script>
            const deleteTenant = () => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('destroyTenant'),
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

            const deleteDue = ($due) => {
                Swal.fire({
                    title: "{{ __('app.Are you sure?') }}",
                    text: "{!! __('app.You wont be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonText: "{{ __('app.Cancel') }}",
                    confirmButtonText: "{{ __('app.Yes, delete it!') }}",
                    showLoaderOnConfirm: true,
                    preConfirm: () => @this.call('destroyDue', $due),
                });
            };
        </script>
    @endpush
</div>
