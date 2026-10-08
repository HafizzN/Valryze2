<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Smart HR Portal - Sistem Manajemen Absensi & SDM Digital">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    <script>
        // Default: light mode. Only apply dark if explicitly set.
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
            if (!localStorage.getItem('theme')) localStorage.setItem('theme', 'light');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Minimalismo Funcional B2B Design Tokens */
        :root {
            /* Surfaces & Backgrounds */
            --bg-base:     #F8F8F8;
            --bg-sidebar:  #212529;
            --bg-topbar:   #FFFFFF;
            --bg-card:     #FFFFFF;
            --bg-elevated: #F8F8F8;
            --bg-hover:    #F1F3F5;

            /* Accent / Tertiary (Corporate Blue) */
            --em:          #007BFF;
            --em-light:    #3395FF;
            --em-dark:     #0056B3;
            --em-ghost:    rgba(0, 123, 255, 0.08);
            --em-border:   rgba(0, 123, 255, 0.25);
            --em-glow:     transparent;

            /* Text Hierarchy */
            --t1: #212529;
            --t2: #343A40;
            --t3: #6C757D;
            --t4: #ADB5BD;
            --t5: #CED4DA;

            /* Semantic States */
            --success: #28A745;
            --warning: #FFC107;
            --danger:  #DC3545;
            --info:    #007BFF;

            /* Borders */
            --border-dim:  #E9ECEF;
            --border-soft: #DEE2E6;
            --border-em:   #007BFF;

            /* Typography Scale */
            --text-hero: 2.25rem;
            --text-xl:   1.75rem;
            --text-lg:   1.375rem;
            --text-md:   1.1rem;
            --text-base: 0.875rem;
            --text-sm:   0.8125rem;
            --text-xs:   0.75rem;
            --text-2xs:  0.6875rem;

            /* Elevation & Depth (Subtle Only) */
            --shadow-card:     0 2px 8px rgba(0,0,0,0.06);
            --shadow-glow:     none;
            --shadow-elevated: 0 4px 16px rgba(0,0,0,0.08);

            /* Backward Compatibility */
            --body-bg:         var(--bg-base);
            --card-bg:         var(--bg-card);
            --text-main:       var(--t1);
            --text-muted:      var(--t3);
            --border-color:    var(--border-soft);
            --primary:         #007BFF;
            --primary-light:   #3395FF;
            --sidebar-bg:      var(--bg-sidebar);
            --topbar-bg:       var(--bg-topbar);
            --table-header-bg: var(--bg-elevated);
            --table-hover-bg:  var(--bg-hover);
            --input-bg:        #FFFFFF;
            --input-border:    var(--border-soft);
            --hero-label:      #007BFF;
            --hero-sub:        #6C757D;
        }

        .dark {
            --bg-base:     #121417;
            --bg-sidebar:  #181A1E;
            --bg-topbar:   #181A1E;
            --bg-card:     #212529;
            --bg-elevated: #2A2E33;
            --bg-hover:    #343A40;

            --em:          #007BFF;
            --em-light:    #3395FF;
            --em-dark:     #0056B3;
            --em-ghost:    rgba(0, 123, 255, 0.15);
            --em-border:   rgba(0, 123, 255, 0.3);
            --em-glow:     transparent;

            --t1: #F8F9FA;
            --t2: #E9ECEF;
            --t3: #ADB5BD;
            --t4: #6C757D;
            --t5: #495057;

            --success: #28A745;
            --warning: #FFC107;
            --danger:  #DC3545;
            --info:    #007BFF;

            --border-dim:  #2A2E33;
            --border-soft: #343A40;
            --border-em:   #007BFF;

            --shadow-card:     0 2px 8px rgba(0,0,0,0.3);
            --shadow-glow:     none;
            --shadow-elevated: 0 4px 16px rgba(0,0,0,0.4);
            --hero-label:      #3395FF;
            --hero-sub:        #ADB5BD;
        }

        html, body { height: 100%; }
        body { background: var(--bg-base); color: var(--t1); }
        body, .topbar, .card, .stat-card, .btn, .form-control, table, tr, td, th {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.15s ease;
        }

        /* MAIN + TOPBAR */
        .main-content { min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            background: var(--bg-topbar);
            border-bottom: 1px solid var(--border-soft);
            padding: 0 1.5rem; height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }

        /* App Layout Wrapper */
        .app-layout {
            display: flex;
            min-height: calc(100vh - 56px);
            margin-top: 56px;
            width: 100%;
        }

        /* Sidebar styles */
        .sidebar {
            width: 210px;
            background: #212529;
            border-right: 1px solid #2B3035;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 40;
            height: calc(100vh - 56px);
            position: sticky;
            top: 56px;
            overflow-y: auto;
        }
        .sidebar-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.55rem 0.85rem;
            border-radius: 4px;
            text-decoration: none;
            color: #ADB5BD;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: all 0.15s ease;
            cursor: pointer;
            border: none;
            background: transparent;
            margin-bottom: 0.15rem;
        }
        .sidebar-item:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.06);
        }
        .sidebar-item.active {
            color: #FFFFFF;
            background: rgba(0, 123, 255, 0.18);
            font-weight: 600;
            border-left: 2px solid #007BFF;
            border-radius: 0 4px 4px 0;
        }
        .sidebar-subitem {
            padding: 0.4rem 0.75rem;
            border-radius: 4px;
            font-size: 0.78rem;
            color: #868E96;
            text-decoration: none;
            transition: all 0.15s;
            display: flex;
            align-items: center;
        }
        .sidebar-subitem:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
        }
        .sidebar-subitem.active {
            color: #007BFF;
            background: rgba(0, 123, 255, 0.12);
            font-weight: 600;
        }

        /* Top Navbar links and dropdowns */
        .topnav-dropdown {
            position: absolute; top: 120%; left: 0; min-width: 200px;
            background: #FFFFFF; border: 1px solid var(--border-soft);
            border-radius: 4px; box-shadow: var(--shadow-elevated);
            padding: 0.5rem; display: flex; flex-direction: column; gap: 0.15rem;
            z-index: 100;
        }
        .dark .topnav-dropdown {
            background: #212529;
            border-color: #343A40;
        }
        .topnav-dropdown-item {
            padding: 0.45rem 0.85rem; border-radius: 4px; font-size: 0.8125rem;
            color: var(--t2); text-decoration: none; transition: all 0.15s;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .topnav-dropdown-item:hover { color: var(--em); background: var(--bg-hover); }
        .topnav-dropdown-item.active { color: var(--em); background: var(--em-ghost); font-weight: 600; }

        /* HERO - Clean Minimalist B2B Card */
        .hero-section {
            position: relative; overflow: hidden;
            background: #FFFFFF;
            border: 1px solid var(--border-soft);
            border-radius: 4px; padding: 2rem 2.25rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-card);
        }
        .dark .hero-section {
            background: #212529;
            border-color: #343A40;
        }
        .hero-line { width: 32px; height: 3px; background: var(--em); border-radius: 2px; margin-bottom: 0.75rem; }
        .hero-greeting { font-size: 1.875rem; font-weight: 700; color: var(--t1); letter-spacing: -0.02em; line-height: 1.2; position: relative; z-index:1; }
        .hero-greeting span { color: var(--em); }
        .hero-sub { font-size: 0.875rem; color: var(--t3); margin-top: 0.35rem; position: relative; z-index:1; }
        .hero-kpi { display: flex; gap: 2.5rem; margin-top: 1.5rem; position: relative; z-index: 1; flex-wrap: wrap; }
        .hero-kpi-val   { font-size: 1.875rem; font-weight: 700; color: var(--t1); letter-spacing: -0.02em; line-height: 1; }
        .hero-kpi-val.em { color: var(--em); }
        .hero-kpi-label { font-size: 0.75rem; color: var(--t3); margin-top: 0.25rem; font-weight: 500; }
        .hero-bar       { height: 3px; background: var(--border-dim); border-radius: 2px; overflow: hidden; width: 64px; margin-top: 0.4rem; }
        .hero-bar-fill  { height: 100%; background: var(--em); border-radius: 2px; }
        .hero-status    { position: absolute; right: 2rem; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 0.5rem; z-index: 1; }
        .hero-status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--success); }
        .hero-status-text { font-size: 0.75rem; color: var(--t3); font-weight: 500; }
 
        /* CARDS */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-soft);
            border-radius: 4px; padding: 1.5rem;
            color: var(--t1);
            box-shadow: var(--shadow-card);
            position: relative;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border-color: #CED4DA;
        }
 
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-soft);
            border-radius: 4px; padding: 1.25rem;
            position: relative; color: var(--t1);
            box-shadow: var(--shadow-card);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border-color: #CED4DA;
        }
        .stat-icon {
            width: 40px; height: 40px; border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 0.75rem;
            background: var(--bg-hover);
            color: var(--em);
        }
        .stat-icon svg { width: 20px; height: 20px; }
        .stat-value { font-size: 1.875rem; font-weight: 700; line-height: 1; letter-spacing: -0.02em; color: var(--t1); }
        .stat-label { font-size: var(--text-xs); color: var(--t3); margin-top: 0.35rem; font-weight: 500; }
        .stat-change { font-size: var(--text-xs); margin-top: 0.65rem; }

        /* BADGES */
        .badge { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.55rem; border-radius: 4px; font-size: 0.72rem; font-weight: 600; letter-spacing: 0.01em; }
        .badge-success { background: #E8F5E9; color: #28A745; border: 1px solid #C8E6C9; }
        .badge-warning { background: #FFF9C4; color: #856404; border: 1px solid #FFF59D; }
        .badge-danger  { background: #FFEBEE; color: #DC3545; border: 1px solid #FFCDD2; }
        .badge-info    { background: #E3F2FD; color: #007BFF; border: 1px solid #BBDEFB; }
        .badge-purple  { background: #EDE7F6; color: #5E35B1; border: 1px solid #D1C4E9; }
        .badge-orange  { background: #FFF3E0; color: #E65100; border: 1px solid #FFE0B2; }
        .badge-gray    { background: #F8F9FA; color: #6C757D; border: 1px solid #DEE2E6; }

        /* BUTTONS */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;
            padding: 0.55rem 1.25rem; border-radius: 4px;
            font-size: 0.8125rem; font-weight: 600; cursor: pointer;
            transition: all 0.15s ease;
            border: 1px solid transparent; text-decoration: none; white-space: nowrap;
        }
        .btn:active { transform: translateY(1px) !important; }
        .btn-primary { 
            background: #007BFF; 
            color: #FFFFFF; 
            border-color: #007BFF;
        }
        .btn-primary:hover { 
            background: #0069D9;
            border-color: #0062CC;
            transform: translateY(-1px); 
        }
        .btn-secondary { 
            background: #FFFFFF; 
            color: var(--t2); 
            border: 1px solid var(--border-soft); 
        }
        .btn-secondary:hover { 
            background: #F8F9FA; 
            color: var(--t1); 
            border-color: #CED4DA; 
            transform: translateY(-1px);
        }
        .btn-ghost { 
            background: transparent; 
            color: var(--em); 
            border: 1px solid var(--border-soft); 
        }
        .btn-ghost:hover { 
            background: var(--em-ghost); 
            border-color: var(--em);
            transform: translateY(-1px); 
        }
        .btn-success { 
            background: #28A745; 
            color: #FFFFFF; 
            border-color: #28A745;
        }
        .btn-success:hover { 
            background: #218838; 
            border-color: #1E7E34;
            transform: translateY(-1px); 
        }
        .btn-danger { 
            background: #DC3545; 
            color: #FFFFFF; 
            border-color: #DC3545;
        }
        .btn-danger:hover { 
            background: #C82333; 
            border-color: #BD2130;
            transform: translateY(-1px); 
        }
        .btn-sm { padding: 0.35rem 0.85rem; font-size: 0.75rem; border-radius: 4px; }
        .btn-xs { padding: 0.22rem 0.55rem; font-size: 0.6875rem; border-radius: 4px; }

        /* TABLES */
        .table-container { 
            overflow-x: auto; 
            border-radius: 4px; 
            border: 1px solid var(--border-soft); 
            background: var(--bg-card); 
            box-shadow: var(--shadow-card); 
        }
        table { width: 100%; border-collapse: collapse; }
        thead th { 
            background: var(--bg-elevated); 
            color: var(--t3); 
            font-size: 0.72rem; 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: 0.06em; 
            padding: 0.85rem 1.15rem; 
            text-align: left; 
            border-bottom: 1px solid var(--border-soft); 
        }
        tbody tr { 
            border-bottom: 1px solid var(--border-dim); 
            transition: background-color 0.15s ease; 
            background: var(--bg-card); 
        }
        tbody tr:hover { 
            background: var(--bg-hover); 
        }
        tbody td { padding: 0.85rem 1.15rem; font-size: 0.84rem; color: var(--t2); vertical-align: middle; }
        
        .avatar { 
            display: inline-flex; align-items: center; justify-content: center; 
            width: 34px; height: 34px; border-radius: 4px; 
            background: var(--bg-hover); border: 1px solid var(--border-soft); 
            color: var(--em); font-size: 0.75rem; font-weight: 700; 
            flex-shrink: 0; 
        }
        .avatar:hover { 
            border-color: var(--em); 
        }

        /* FORMS */
        .form-group  { margin-bottom: 1.25rem; }
        .form-label  { display: block; font-size: 0.78rem; font-weight: 600; color: var(--t2); margin-bottom: 0.4rem; }
        .form-control { 
            width: 100%; padding: 0.65rem 0.9rem; 
            background: #FFFFFF; border: 1px solid var(--border-soft); 
            border-radius: 4px; color: var(--t1); font-size: 0.875rem; font-family: inherit; 
            transition: border-color 0.15s ease, box-shadow 0.15s ease; 
        }
        .dark .form-control {
            background: #212529;
            border-color: #343A40;
            color: #F8F9FA;
        }
        .form-control:focus { 
            outline: none; 
            border-color: #007BFF; 
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); 
        }
        .form-control::placeholder { color: var(--t4); }
        select.form-control { cursor: pointer; }
        .form-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.35rem; font-weight: 500; }

        /* ALERTS */
        .alert { 
            padding: 0.85rem 1.15rem; 
            border-radius: 4px; 
            font-size: 0.84rem; 
            margin-bottom: 1.25rem; 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; 
            font-weight: 500;
            border: 1px solid transparent;
        }
        .alert-success { 
            background: #E8F5E9;  
            border-color: #C8E6C9; 
            color: #2E7D32; 
        }
        .alert-error { 
            background: #FFEBEE;   
            border-color: #FFCDD2;  
            color: #C62828; 
        }
        .alert-warning { 
            background: #FFF9C4;  
            border-color: #FFF59D; 
            color: #F57F17; 
        }
        .alert-info { 
            background: #E3F2FD;  
            border-color: #BBDEFB; 
            color: #1565C0; 
        }

        /* GPS */
        #camera-preview { border-radius: 4px; border: 1px solid var(--border-soft); }
        .gps-status { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; }
        .gps-dot { width: 8px; height: 8px; border-radius: 50%; }
        .gps-dot.active  { background: var(--success); }
        .gps-dot.error   { background: var(--danger); }
        .gps-dot.loading { background: var(--warning); }

        .page-content { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn { from{opacity:0; transform: translateY(6px);} to{opacity:1; transform: translateY(0);} }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CED4DA; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #ADB5BD; }

        /* Mobile adjustments */
        @media (max-width: 1024px) {
            .sidebar { display: none; }
            .app-layout { margin-top: 56px; min-height: calc(100vh - 56px); }
        }

        /* Extra small devices (phones, up to 640px) */
        @media (max-width: 640px) {
            .topbar { padding: 0 0.75rem; height: 52px; }
            .app-layout { margin-top: 52px; min-height: calc(100vh - 52px); }
            main.page-content { padding: 1rem !important; }
            .card { padding: 1.25rem; border-radius: 4px; }
            .table-container { border-radius: 4px; }
            .btn { padding: 0.5rem 1rem; font-size: 0.75rem; }
            .form-control { padding: 0.6rem 0.85rem; font-size: 0.85rem; }
            .stat-card { padding: 1rem; }
            .hero-section { padding: 1.5rem 1.25rem; }
        }
    </style>
    @stack('styles')
</head>
<body class="h-full">

    <!-- Topbar (Full Width) -->
    <header class="topbar" x-data="{ mobileMenuOpen: false }">
        <!-- Left: Logo & Mobile Menu Toggle -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded" style="background: #F8F8F8; border: 1px solid var(--border-soft);">
                <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                @if(isset($currentCompany) && $currentCompany?->logo_url)
                    <img src="{{ $currentCompany->logo_url }}" alt="{{ $currentCompany->name }}" style="height: 28px; max-width: 100px; object-fit: contain; border-radius: 4px;">
                @else
                    <div class="brand-icon" style="width: 28px; height: 28px; border-radius: 4px; display: flex; align-items: center; justify-content: center; background: #007BFF; flex-shrink: 0;">
                        <svg style="width: 14px; height: 14px; color: #FFFFFF; fill: #FFFFFF;" viewBox="0 0 24 24" fill="currentColor"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                @endif
                <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-size: 14px; color: var(--t1); letter-spacing: 0.05em;">
                    {{ isset($currentCompany) && $currentCompany?->name ? $currentCompany->name : 'VALRYZE' }}
                </span>
            </div>
        </div>

        <!-- Middle: Search Bar (Max 448px) -->
        <div style="flex: 1; max-width: 448px; position: relative;" class="hidden md:block" x-data="globalSearchApp()">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="width: 16px; height: 16px; color: var(--t3); pointer-events: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                type="text"
                x-model="query"
                @input.debounce.300ms="performSearch"
                @keydown.escape="clearSearch"
                @blur="clearSearch"
                placeholder="Cari karyawan, divisi, cuti, pengumuman..."
                style="width: 100%; padding: 0.45rem 1rem 0.45rem 2.25rem; background: var(--bg-elevated); border: 1px solid var(--border-soft); border-radius: 4px; font-size: 0.8125rem; color: var(--t1); outline: none; transition: border-color 0.15s, box-shadow 0.15s;"
                onfocus="this.style.borderColor='#007BFF'; this.style.boxShadow='0 0 0 2px rgba(0, 123, 255, 0.25)';"
                onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';"
            >

            <!-- Search Dropdown Results -->
            <div x-show="results.length > 0" 
                 style="position: absolute; left: 0; right: 0; top: 115%; background: var(--bg-card); border: 1px solid var(--border-soft); border-radius: 4px; box-shadow: var(--shadow-elevated); z-index: 999; max-height: 320px; overflow-y: auto; padding: 0.4rem;"
                 x-transition>
                <template x-for="item in results" :key="item.url + item.title">
                    <a :href="item.url" 
                       style="display: flex; align-items: center; justify-content: space-between; padding: 0.6rem 0.8rem; border-radius: 4px; text-decoration: none; transition: all 0.15s; margin-bottom: 2px;"
                       class="hover:bg-slate-100 group">
                        <div style="min-width: 0; flex: 1; padding-right: 0.5rem;">
                            <div style="font-size: 0.8125rem; font-weight: 600; color: var(--t1);" x-text="item.title"></div>
                            <div style="font-size: 0.72rem; color: var(--t3); margin-top: 1px;" x-text="item.sub"></div>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase shrink-0" 
                              style="background: rgba(0, 123, 255, 0.1); color: #007BFF;"
                              x-text="item.type"></span>
                    </a>
                </template>
            </div>
            
            <!-- Loading Indicator -->
            <div x-show="loading" 
                 style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                 class="flex items-center">
                 <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                     <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                     <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                 </svg>
            </div>
        </div>

        <!-- Right: export, clock, theme, notif, user avatar dropdown -->
        <div class="flex items-center gap-3">
            <!-- Ekspor (outline) -->
            <button
                class="flex items-center gap-1.5 px-3 py-1.5 rounded transition-colors"
                style="border: 1px solid var(--border-soft); color: var(--t1); background: #FFFFFF; cursor: pointer; border-radius: 4px;"
                onmouseenter="this.style.background='var(--bg-hover)'; this.style.borderColor='#CED4DA';"
                onmouseleave="this.style.background='#FFFFFF'; this.style.borderColor='var(--border-soft)';"
                onclick="window.location.href='{{ route('reports.attendance.export') }}'"
            >
                <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span style="font-family: 'Inter',sans-serif; font-size: 12px; font-weight: 600;">Ekspor</span>
            </button>

            <!-- Live clock -->
            <div class="hidden sm:block" style="font-size: 0.75rem; color: var(--t2); font-variant-numeric: tabular-nums; padding: 0.35rem 0.75rem; background: var(--bg-elevated); border: 1px solid var(--border-soft); border-radius: 4px; font-weight: 500;" id="live-clock"></div>

            <!-- Theme Toggle -->
            <button id="theme-toggle" class="p-2 rounded" style="background: var(--bg-elevated); border: 1px solid var(--border-soft); border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" title="Ubah Tema"
                onmouseover="this.style.background='var(--bg-hover)'" onmouseout="this.style.background='var(--bg-elevated)'">
                <svg id="theme-toggle-dark-icon" class="w-4 h-4 hidden text-slate-700" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="w-4 h-4 hidden text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.46 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>

            <!-- Notifications -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative p-2 rounded" style="background: var(--bg-elevated); border: 1px solid var(--border-soft); border-radius: 4px; cursor: pointer; display:flex; align-items:center; transition: background 0.2s;"
                    onmouseover="this.style.background='var(--bg-hover)'" onmouseout="this.style.background='var(--bg-elevated)'">
                    <svg class="w-4 h-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @php $unread = auth()->user()->unreadNotificationsCount(); @endphp
                    @if($unread > 0)
                    <span style="position:absolute; top:-2px; right:-2px; width:16px; height:16px; background:#DC3545; border-radius:50%; color:white; font-size:0.55rem; display:flex; align-items:center; justify-content:center; font-weight:700;">{{ $unread }}</span>
                    @endif
                </button>
                <div x-show="open" @click.away="open = false" x-transition style="position: absolute; right: 0; top: 120%; width: 320px; background: var(--bg-card); border: 1px solid var(--border-soft); border-radius: 4px; box-shadow: var(--shadow-elevated); z-index: 100; overflow: hidden;">
                    <div style="padding: 0.85rem 1rem; border-bottom: 1px solid var(--border-soft); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--t1);">Notifikasi</span>
                        @if($unread > 0)
                        <button onclick="fetch('/notifications/read-all', {method:'POST', headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'}}).then(() => window.location.reload())" style="font-size: 0.72rem; color: #007BFF; background: none; border: none; cursor: pointer; font-weight: 600;">Tandai dibaca</button>
                        @endif
                    </div>
                    @forelse(auth()->user()->notifications()->latest()->limit(5)->get() as $notif)
                    <div onclick="fetch('/notifications/{{ $notif->id }}/read', {method:'POST', headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'}}).then(() => window.location.reload())"
                         style="padding: 0.75rem 1rem; border-bottom: 1px solid var(--border-soft); {{ $notif->read_at ? '' : 'background: rgba(0, 123, 255, 0.04);' }} transition: background 0.15s; cursor: pointer;" 
                         onmouseover="this.style.background='var(--bg-hover)'" 
                         onmouseout="this.style.background='{{ $notif->read_at ? '' : 'rgba(0, 123, 255, 0.04)' }}'">
                        <div style="font-size: 0.8125rem; font-weight: 600; color: var(--t1); display: flex; align-items: center; gap: 0.4rem;">
                            @if(!$notif->read_at)
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 shrink-0"></span>
                            @endif
                            <span>{{ $notif->title }}</span>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--t3); margin-top: 0.2rem;">{{ $notif->message }}</div>
                        <div style="font-size: 0.6875rem; color: var(--t4); margin-top: 0.3rem;">{{ $notif->created_at->diffForHumans() }}</div>
                    </div>
                    @empty
                    <div style="padding: 2rem; text-align: center; color: var(--t3); font-size: 0.8125rem;">Tidak ada notifikasi</div>
                    @endforelse
                    <a href="{{ route('notifications.index') }}" style="display: block; padding: 0.75rem; text-align: center; font-size: 0.75rem; color: #007BFF; border-top: 1px solid var(--border-soft); text-decoration: none; font-weight: 600;">Lihat semua</a>
                </div>
            </div>

            <!-- User profile dropdown -->
            <div x-data="{ open: false }" class="relative" @click.away="open = false">
                <button @click="open = !open" class="avatar" style="overflow: hidden; font-size: 0.72rem; cursor: pointer; border-radius: 4px;">
                    @if(auth()->user()->photo)
                        <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ auth()->user()->initials }}
                    @endif
                </button>
                <div x-show="open" x-transition class="topnav-dropdown" style="right: 0; left: auto; width: 220px; top: 120%;">
                    <div style="padding: 0.5rem 0.85rem; border-bottom: 1px solid var(--border-soft); margin-bottom: 0.25rem;">
                        <div style="font-size: 0.8125rem; font-weight: 700; color: var(--t1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 0.6875rem; color: var(--t3);">{{ auth()->user()->role_label }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="topnav-dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="topnav-dropdown-item w-full text-left" style="color: #DC3545; border: none; background: transparent; cursor: pointer;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- App layout wrapper (Sidebar + Content) -->
    <div class="app-layout">
        <!-- Sidebar (Left, 210px) -->
        <aside class="sidebar hidden lg:flex">
            <div style="padding: 1rem 0.75rem; width: 100%;">
                <span style="font-family: 'Plus Jakarta Sans',sans-serif; font-size: 9px; font-weight: 700; letter-spacing: 0.12em; color: var(--t4); display: block; margin-bottom: 0.75rem; padding-left: 0.5rem;">
                    MENU UTAMA
                </span>

                <nav style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Dashboard</span>
                        </div>
                        @if(request()->routeIs('dashboard'))
                            <span style="font-size: 0.7rem;">&gt;</span>
                        @endif
                    </a>

                    <!-- Kalender -->
                    <a href="{{ route('calendar.index') }}" class="sidebar-item {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Kalender</span>
                        </div>
                        @if(request()->routeIs('calendar.index'))
                            <span style="font-size: 0.7rem;">&gt;</span>
                        @endif
                    </a>

                    <!-- Attendance Collapsible -->
                    <div x-data="{ open: {{ request()->routeIs('attendance.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('attendance.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>Attendance</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('attendance.check-in') }}" class="sidebar-subitem {{ request()->routeIs('attendance.check-in') ? 'active' : '' }}">Absen Masuk</a>
                            <a href="{{ route('attendance.check-out') }}" class="sidebar-subitem {{ request()->routeIs('attendance.check-out') ? 'active' : '' }}">Absen Pulang</a>
                            <a href="{{ route('attendance.history') }}" class="sidebar-subitem {{ request()->routeIs('attendance.history') ? 'active' : '' }}">Riwayat</a>
                        </div>
                    </div>

                    <!-- Leave Collapsible -->
                    <div x-data="{ open: {{ request()->routeIs('leave.*') || request()->routeIs('permission.*') || request()->routeIs('overtime.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('leave.*') || request()->routeIs('permission.*') || request()->routeIs('overtime.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Leave & Permits</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('leave.index') }}" class="sidebar-subitem {{ request()->routeIs('leave.index') ? 'active' : '' }}">Cuti</a>
                            <a href="{{ route('permission.index') }}" class="sidebar-subitem {{ request()->routeIs('permission.index') ? 'active' : '' }}">Izin</a>
                            <a href="{{ route('overtime.index') }}" class="sidebar-subitem {{ request()->routeIs('overtime.index') ? 'active' : '' }}">Lembur</a>
                        </div>
                    </div>

                    <!-- Documents Collapsible -->
                    <div x-data="{ open: {{ request()->routeIs('letters.*') || request()->routeIs('documents.*') || request()->routeIs('announcements.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('letters.*') || request()->routeIs('documents.*') || request()->routeIs('announcements.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Documents</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('letters.index') }}" class="sidebar-subitem {{ request()->routeIs('letters.index') ? 'active' : '' }}">Surat Menyurat</a>
                            <a href="{{ route('documents.index') }}" class="sidebar-subitem {{ request()->routeIs('documents.index') ? 'active' : '' }}">File Bersama</a>
                            <a href="{{ route('announcements.index') }}" class="sidebar-subitem {{ request()->routeIs('announcements.index') ? 'active' : '' }}">Pengumuman</a>
                        </div>
                    </div>

                    <!-- Master Data Collapsible (Admin/HRD only) -->
                    @hasrole(['super_admin', 'hrd'])
                    <div x-data="{ open: {{ request()->routeIs('master.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('master.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                <span>Master Data</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('master.divisions.index') }}" class="sidebar-subitem {{ request()->routeIs('master.divisions.*') ? 'active' : '' }}">Divisi</a>
                            <a href="{{ route('master.positions.index') }}" class="sidebar-subitem {{ request()->routeIs('master.positions.*') ? 'active' : '' }}">Jabatan</a>
                            <a href="{{ route('master.shifts.index') }}" class="sidebar-subitem {{ request()->routeIs('master.shifts.*') ? 'active' : '' }}">Shift Kerja</a>
                            <a href="{{ route('master.locations.index') }}" class="sidebar-subitem {{ request()->routeIs('master.locations.*') ? 'active' : '' }}">Lokasi GPS</a>
                        </div>
                    </div>
                    @endhasrole

                    <!-- Reports Collapsible (Admin/Manager only) -->
                    @hasrole(['super_admin', 'hrd', 'manager'])
                    <div x-data="{ open: {{ request()->routeIs('reports.*') || request()->routeIs('employees.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('reports.*') || request()->routeIs('employees.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Reports</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            @hasrole(['super_admin', 'hrd'])
                            <a href="{{ route('employees.index') }}" class="sidebar-subitem {{ request()->routeIs('employees.*') ? 'active' : '' }}">Data Karyawan</a>
                            @endhasrole
                            <a href="{{ route('reports.attendance') }}" class="sidebar-subitem {{ request()->routeIs('reports.attendance') ? 'active' : '' }}">Laporan Absen</a>
                            <a href="{{ route('reports.lateness') }}" class="sidebar-subitem {{ request()->routeIs('reports.lateness') ? 'active' : '' }}">Lateness</a>
                            <a href="{{ route('reports.leave') }}" class="sidebar-subitem {{ request()->routeIs('reports.leave') ? 'active' : '' }}">Laporan Cuti</a>
                            <a href="{{ route('reports.gps') }}" class="sidebar-subitem {{ request()->routeIs('reports.gps') ? 'active' : '' }}">Peta Lokasi GPS</a>
                        </div>
                    </div>
                    @endhasrole

                    <!-- Payroll Collapsible (Admin/HRD/Manager only) -->
                    @hasrole(['super_admin', 'hrd', 'manager'])
                    <div x-data="{ open: {{ request()->routeIs('payroll.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('payroll.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Payroll</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('payroll.index') }}" class="sidebar-subitem {{ request()->routeIs('payroll.index') ? 'active' : '' }}">Pengaturan Gaji</a>
                        </div>
                    </div>
                    @endhasrole

                    <!-- Settings Collapsible (Admin only) -->
                    @hasrole('super_admin')
                    <div x-data="{ open: {{ request()->routeIs('settings.*') ? 'true' : 'false' }} }" style="display: flex; flex-direction: column;">
                        <button @click="open = !open" class="sidebar-item w-full" :class="open || {{ request()->routeIs('settings.*') ? 'true' : 'false' }} ? 'active' : ''">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Settings</span>
                            </div>
                            <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.15rem; margin-top: 0.15rem; margin-bottom: 0.25rem;">
                            <a href="{{ route('settings.company') }}" class="sidebar-subitem {{ request()->routeIs('settings.company') ? 'active' : '' }}">Profil Kantor</a>
                            <a href="{{ route('settings.users.index') }}" class="sidebar-subitem {{ request()->routeIs('settings.users.*') ? 'active' : '' }}">User Manajemen</a>
                            <a href="{{ route('settings.audit-logs') }}" class="sidebar-subitem {{ request()->routeIs('settings.audit-logs') ? 'active' : '' }}">Audit Logs</a>
                        </div>
                    </div>
                    @endhasrole
                </nav>
            </div>

            <!-- Sidebar footer section -->
            <div style="padding: 1rem 0.75rem; border-top: 1px solid var(--border-soft); margin-top: auto; width: 100%;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #22C55E; box-shadow: 0 0 10px #22C55E;" class="animate-pulse"></div>
                    <span style="font-size: 0.75rem; color: #22C55E; font-weight: 700;">System Healthy</span>
                </div>
                <div style="font-size: 0.65rem; color: var(--t4);">Last sync 2 min ago</div>
                <div style="font-size: 0.65rem; color: var(--t5); margin-top: 0.15rem; font-family: monospace;">VALRYZE v1.0.0</div>
            </div>
        </aside>

        <!-- Main Content area -->
        <div style="flex: 1; display: flex; flex-direction: column; overflow-y: auto;" class="main-content">
            <!-- Page content -->
            <main class="flex-1 p-6 page-content">
                {{-- Flash Messages --}}
                @if(session('success'))
                <div class="alert alert-success">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-error">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
                @endif
                @if(session('info'))
                <div class="alert alert-info">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('info') }}
                </div>
                @endif

                @yield('content')
            </main>

            <!-- Status Bar (Bottom, Full Width inside content area) -->
            <footer class="status-bar" style="height: 28px; background: #FFFFFF; border-top: 1px solid var(--border-soft); display: flex; align-items: center; justify-content: space-between; padding: 0 1rem; font-size: 0.72rem; color: var(--t3); flex-shrink: 0; z-index: 100;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 7px; height: 7px; border-radius: 50%; background: var(--success);"></span>
                    <span>Sistem normal</span>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; font-family: 'JetBrains Mono', monospace; font-size: 0.7rem;">
                    @php
                        $onTimeRateStatus = 100;
                        try {
                            $presentStatusCount = \App\Models\Attendance::where('date', date('Y-m-d'))->where('status', 'present')->count();
                            $lateStatusCount = \App\Models\Attendance::where('date', date('Y-m-d'))->where('status', 'late')->count();
                            $totalStatusCount = $presentStatusCount + $lateStatusCount;
                            $onTimeRateStatus = $totalStatusCount > 0 ? round(($presentStatusCount / $totalStatusCount) * 100, 1) : 100;
                        } catch(\Exception $e) {}
                    @endphp
                    <span>{{ $onTimeRateStatus }}% On-time</span>
                    <span>·</span>
                    <span id="status-bar-clock">00:00</span>
                    <span>·</span>
                    <span>VALRYZE B2B</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Menu Backdrop -->
    <div x-show="mobileMenuOpen" x-transition x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false" class="lg:hidden fixed inset-0 z-40 bg-black/50" style="top: 56px;"></div>

    <!-- Mobile Navigation Drawer (Dropdown mobile alternative) -->
    <div x-show="mobileMenuOpen" x-transition @click.away="mobileMenuOpen = false" class="lg:hidden" x-bind:style="mobileMenuOpen ? 'display: flex; flex-direction: column;' : 'display: none;'" style="position: fixed; top: 56px; left: 0; right: 0; background: var(--bg-topbar); border-bottom: 1px solid var(--border-soft); padding: 1rem; gap: 0.5rem; z-index: 45; max-height: calc(100vh - 56px); overflow-y: auto;">
        <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('calendar.index') }}" @click="mobileMenuOpen = false" class="sidebar-item {{ request()->routeIs('calendar.*') ? 'active' : '' }}">Kalender</a>
        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Absensi</div>
        <a href="{{ route('attendance.check-in') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('attendance.check-in') ? 'active' : '' }}">Absen Masuk</a>
        <a href="{{ route('attendance.check-out') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('attendance.check-out') ? 'active' : '' }}">Absen Pulang</a>
        <a href="{{ route('attendance.history') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('attendance.history') ? 'active' : '' }}">Riwayat Absen</a>

        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Perizinan</div>
        <a href="{{ route('permission.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('permission.index') ? 'active' : '' }}">Izin</a>
        <a href="{{ route('leave.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('leave.index') ? 'active' : '' }}">Cuti</a>
        <a href="{{ route('overtime.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('overtime.index') ? 'active' : '' }}">Lembur</a>

        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Dokumen</div>
        <a href="{{ route('letters.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('letters.index') ? 'active' : '' }}">Surat Menyurat</a>
        <a href="{{ route('documents.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('documents.index') ? 'active' : '' }}">File Bersama</a>
        <a href="{{ route('announcements.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('announcements.index') ? 'active' : '' }}">Pengumuman</a>

        @hasrole(['super_admin', 'hrd'])
        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Manajemen & Laporan</div>
        <a href="{{ route('employees.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('employees.index') ? 'active' : '' }}">Data Karyawan</a>
        <a href="{{ route('reports.attendance') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('reports.attendance') ? 'active' : '' }}">Laporan Absen</a>
        <a href="{{ route('reports.lateness') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('reports.lateness') ? 'active' : '' }}">Lateness</a>
        <a href="{{ route('reports.leave') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('reports.leave') ? 'active' : '' }}">Laporan Cuti</a>
        <a href="{{ route('reports.gps') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('reports.gps') ? 'active' : '' }}">Peta Lokasi GPS</a>
        @endhasrole

        @hasrole(['super_admin', 'hrd'])
        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Master Data</div>
        <a href="{{ route('master.divisions.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('master.divisions.*') ? 'active' : '' }}">Divisi</a>
        <a href="{{ route('master.positions.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('master.positions.*') ? 'active' : '' }}">Jabatan</a>
        <a href="{{ route('master.shifts.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('master.shifts.*') ? 'active' : '' }}">Shift Kerja</a>
        <a href="{{ route('master.locations.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('master.locations.*') ? 'active' : '' }}">Lokasi GPS</a>
        @endhasrole

        @hasrole('super_admin')
        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--t4); padding-left: 0.75rem; font-weight: 700; margin-top: 0.25rem;">Settings</div>
        <a href="{{ route('settings.company') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('settings.company') ? 'active' : '' }}">Profil Kantor</a>
        <a href="{{ route('settings.users.index') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('settings.users.*') ? 'active' : '' }}">User Manajemen</a>
        <a href="{{ route('settings.audit-logs') }}" @click="mobileMenuOpen = false" class="sidebar-subitem {{ request()->routeIs('settings.audit-logs') ? 'active' : '' }}">Audit Logs</a>
        @endhasrole
    </div>

    <script>
        // Live clocks
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit', second: '2-digit'}) + ' WIB';
            const statusTimeStr = now.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
            
            const liveClock = document.getElementById('live-clock');
            if (liveClock) liveClock.textContent = timeStr;
            
            const statusClock = document.getElementById('status-bar-clock');
            if (statusClock) statusClock.textContent = statusTimeStr;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Theme Toggle
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        const themeToggleBtn = document.getElementById('theme-toggle');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            });
        }

        function globalSearchApp() {
            return {
                query: '',
                results: [],
                loading: false,
                performSearch() {
                    if (this.query.trim().length < 2) {
                        this.results = [];
                        return;
                    }
                    this.loading = true;
                    fetch(`/global-search?q=${encodeURIComponent(this.query)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.results = data;
                            this.loading = false;
                        })
                        .catch(err => {
                            console.error(err);
                            this.loading = false;
                        });
                },
                clearSearch() {
                    // Slight delay to allow click on links before closing
                    setTimeout(() => {
                        this.query = '';
                        this.results = [];
                    }, 200);
                }
            };
        }
    </script>

    @if(auth()->check() && auth()->user()->birth_date && auth()->user()->birth_date->format('m-d') === now()->format('m-d'))
        <!-- Birthday Celebration overlay + script -->
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <div id="birthday-celebration-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm transition-opacity duration-300" style="display: none;">
            <div class="card max-w-sm w-full p-6 text-center shadow-2xl scale-95 transform transition-transform duration-300 relative overflow-hidden" style="background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%); border: 2px solid #ec4899;">
                <div class="relative z-10 space-y-4">
                    <div class="w-16 h-16 bg-pink-500/10 border-2 border-pink-500/30 rounded-full flex items-center justify-center mx-auto shadow-lg shadow-pink-500/20">
                        <span class="text-3xl animate-bounce">🎂</span>
                    </div>
                    
                    <h2 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-indigo-400">Selamat Ulang Tahun! 🎉</h2>
                    <p class="text-slate-200 text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Manajemen & segenap rekan kerja di PT. Smart Teknologi Indonesia mengucapkan Selamat Hari Ulang Tahun! Semoga panjang umur, sehat selalu, dan dilancarkan segala urusannya. 🌟
                    </p>
                    
                    <div class="pt-2">
                        <button onclick="closeBirthdayCelebration()" class="btn btn-primary w-full justify-center" style="background: linear-gradient(135deg, #ec4899, #be185d); box-shadow: 0 4px 14px rgba(236,72,153,0.4);">
                            Terima Kasih! ❤️
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const today = new Date().toISOString().slice(0, 10);
                const storageKey = 'birthday_shown_{{ auth()->id() }}_' + today;
                const hasShown = localStorage.getItem(storageKey);
                const modal = document.getElementById('birthday-celebration-modal');

                if (hasShown) {
                    if (modal) {
                        modal.remove();
                    }
                    return;
                }

                // Show modal & record to localStorage
                if (modal) {
                    modal.style.display = 'flex';
                }
                localStorage.setItem(storageKey, 'true');

                // Shoot confetti!
                const end = Date.now() + (3 * 1000); // 3 seconds
                const colors = ['#ec4899', '#3b82f6', '#10b981', '#f59e0b'];

                (function frame() {
                    confetti({
                        particleCount: 2,
                        angle: 60,
                        spread: 55,
                        origin: { x: 0 },
                        colors: colors
                    });
                    confetti({
                        particleCount: 2,
                        angle: 120,
                        spread: 55,
                        origin: { x: 1 },
                        colors: colors
                    });

                    if (Date.now() < end) {
                        requestAnimationFrame(frame);
                    }
                }());

                confetti({
                    particleCount: 80,
                    spread: 70,
                    origin: { y: 0.6 },
                    colors: colors
                });
            });

            function closeBirthdayCelebration() {
                const modal = document.getElementById('birthday-celebration-modal');
                if (modal) {
                    modal.style.opacity = '0';
                    setTimeout(() => modal.remove(), 300);
                }
            }
        </script>
    @endif

    @stack('scripts')
</body>
</html>
