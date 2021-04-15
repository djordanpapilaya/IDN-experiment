@props(['value'])

<label class="font-medium text-sm text-gray-900 pb-5">
    {{ $value ?? $slot }}
</label>
