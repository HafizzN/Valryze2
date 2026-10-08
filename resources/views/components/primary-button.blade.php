<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150']) }}
    style="background:#007BFF;border-radius:4px;font-weight:600;"
    onmouseover="this.style.background='#0056B3'"
    onmouseout="this.style.background='#007BFF'"
>
    {{ $slot }}
</button>
