<script>
    @if (session()->has('success'))
        notyf.success("{{ session()->get('success') }}")
    @endif

    @if (session()->has('error'))
        notyf.error("{{ session()->get('error') }}")
    @endif

    Livewire.on('success', message => notyf.success(message));
    Livewire.on('error', message => notyf.error(message));
    Livewire.on('success-alert', (title, message) => Swal.fire(title, message, 'success'));
    Livewire.on('error-alert', (title, message) => Swal.fire(title, message, 'error'));
</script>
