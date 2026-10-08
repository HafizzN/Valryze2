<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border rounded font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 disabled:opacity-25']) }}
    style="border:1.5px solid #DEE2E6;color:#007BFF;border-radius:4px;font-weight:600;"
    onmouseover="this.style.background='#F8F8F8'"
    onmouseout="this.style.background='white'"
>
    {{ $slot }}
</button>
