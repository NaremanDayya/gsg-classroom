<div class="form-floating mb-3">
    {{-- عشان نظهر المحتوى --}}
    {{ $slot }}
    {{ $label }}
    <x-form.input-error name="{{ $name }}" />
</div>