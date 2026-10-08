<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VALRYZE') }} — Portal B2B</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        </style>
    </head>
    <body class="bg-[#F8F8F8] text-[#212529] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 p-4">
            <div class="mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded bg-[#007BFF] flex items-center justify-center text-white font-bold text-sm">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-tight text-[#212529]">
                    VAL<span class="text-[#007BFF]">RYZE</span>
                </span>
            </div>

            <div class="w-full sm:max-w-md bg-white border border-[#DEE2E6] shadow-[0_2px_8px_rgba(0,0,0,0.06)] rounded p-6 sm:p-8">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-xs text-[#6C757D]">
                &copy; {{ date('Y') }} VALRYZE HR B2B Portal. All rights reserved.
            </div>
        </div>
    </body>
</html>
