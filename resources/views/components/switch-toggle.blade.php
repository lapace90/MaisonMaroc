<div class="custom-switch">
    <input type="checkbox" class="custom-control-input" id="{{ $id }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }}>
    <label class="custom-control-label" for="{{ $id }}">
        {{ $label }}
    </label>
</div>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchToggle = document.getElementById('{{ $id }}');
        switchToggle.addEventListener('change', function() {
            const status = switchToggle.checked ? 'active' : 'inactive';
            switchToggle.nextElementSibling.textContent = switchToggle.checked ? 'Visible sur le site' : 'Désactivé';
        });
    });
</script>
{{-- // Update status label dynamically based on toggle switch
const statusToggle = document.getElementById('status');
const statusLabel = document.querySelector('label[for="status"]');
statusToggle.addEventListener('change', function() {
    statusLabel.textContent = statusToggle.checked ? 'Visible sur le site' : 'Non disponible';
}); --}}