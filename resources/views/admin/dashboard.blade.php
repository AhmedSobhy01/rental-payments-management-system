<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">
                    @livewire('admin.summary.unpaid-dues')
                </div>
                <div class="p-6">
                    @livewire('admin.summary.recently-expired-contracts')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
