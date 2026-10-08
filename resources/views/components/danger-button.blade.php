<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150']) }}
    style="background:#DC3545;border-radius:4px;font-weight:600;"
    onmouseover="this.style.background='#BB2D3B'"
    onmouseout="this.style.background='#DC3545'"
>
    {{ $slot }}
</button>
