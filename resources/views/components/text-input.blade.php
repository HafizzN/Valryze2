@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border rounded-sm shadow-none w-full transition duration-150']) }}
    style="border:1px solid #DEE2E6;border-radius:4px;padding:0.5rem 0.75rem;background:#FFFFFF;color:#212529;font-size:0.875rem;outline:none;"
    onfocus="this.style.borderColor='#007BFF';this.style.boxShadow='0 0 0 2px rgba(0,123,255,0.15)'"
    onblur="this.style.borderColor='#DEE2E6';this.style.boxShadow='none'"
>
