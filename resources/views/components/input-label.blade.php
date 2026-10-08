@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm']) }} style="color:#212529;font-weight:500;margin-bottom:0.35rem;">
    {{ $value ?? $slot }}
</label>
