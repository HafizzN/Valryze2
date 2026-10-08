<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="VALRYZE B2B HR & Project Management Portal - Login">
    <title>Masuk ke Portal — {{ config('app.name', 'VALRYZE') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', system-ui, -apple-system, sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; background: #F8F8F8; color: #212529; display: flex; }

        .auth-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left: B2B Brand Panel */
        .auth-left {
            flex: 1.1;
            background: #FFFFFF;
            border-right: 1px solid #DEE2E6;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3.5rem;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }
        .brand-icon {
            width: 32px;
            height: 32px;
            background: #007BFF;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            flex-shrink: 0;
        }
        .brand-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #212529;
            letter-spacing: -0.01em;
        }
        .brand-title span { color: #007BFF; }

        .brand-hero {
            max-width: 540px;
            margin: auto 0;
            padding: 2rem 0;
        }
        .hero-tag {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #007BFF;
            background: rgba(0, 123, 255, 0.08);
            border: 1px solid rgba(0, 123, 255, 0.2);
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
        }
        .hero-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.25;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
        }
        .hero-desc {
            font-size: 1rem;
            line-height: 1.6;
            color: #6C757D;
            margin-bottom: 2.5rem;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
        }
        .feature-icon-box {
            width: 36px;
            height: 36px;
            border-radius: 4px;
            background: #F8F8F8;
            border: 1px solid #DEE2E6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #007BFF;
            flex-shrink: 0;
        }
        .feature-item-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #212529;
        }
        .feature-item-desc {
            font-size: 0.8125rem;
            color: #6C757D;
            margin-top: 0.15rem;
            line-height: 1.5;
        }

        .auth-footer {
            font-size: 0.8125rem;
            color: #ADB5BD;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Right: Login Form */
        .auth-right {
            width: 480px;
            background: #F8F8F8;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
        }
        .login-card {
            width: 100%;
            background: #FFFFFF;
            border: 1px solid #DEE2E6;
            border-radius: 4px;
            padding: 2.25rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .form-heading {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
            letter-spacing: -0.02em;
            margin-bottom: 0.35rem;
        }
        .form-sub {
            font-size: 0.875rem;
            color: #6C757D;
            margin-bottom: 1.75rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.4rem;
        }
        .form-control {
            width: 100%;
            padding: 0.65rem 0.85rem;
            background: #FFFFFF;
            border: 1px solid #DEE2E6;
            border-radius: 4px;
            color: #212529;
            font-size: 0.875rem;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .form-control:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
        .form-control::placeholder { color: #ADB5BD; }

        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background: #007BFF;
            color: #FFFFFF;
            border: 1px solid #007BFF;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, transform 0.15s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            background: #0069D9;
            border-color: #0062CC;
            transform: translateY(-1px);
        }
        .btn-submit:active { transform: translateY(1px); }

        .demo-panel {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #F8F8F8;
            border: 1px solid #DEE2E6;
            border-radius: 4px;
        }
        .demo-title {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6C757D;
            margin-bottom: 0.5rem;
        }
        .demo-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            padding: 0.2rem 0;
            border-bottom: 1px solid #E9ECEF;
        }
        .demo-row:last-child { border-bottom: none; }
        .demo-email {
            font-family: 'JetBrains Mono', monospace;
            color: #212529;
        }
        .demo-badge {
            color: #6C757D;
            font-weight: 500;
        }
        .demo-pwd {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: #6C757D;
        }
        .demo-pwd code {
            font-family: 'JetBrains Mono', monospace;
            background: #FFFFFF;
            padding: 0.1rem 0.35rem;
            border: 1px solid #DEE2E6;
            border-radius: 3px;
            color: #007BFF;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .auth-left { display: none; }
            .auth-right { width: 100%; padding: 2rem 1.25rem; }
            .login-card { max-width: 440px; margin: 0 auto; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left: Brand Presentation -->
        <div class="auth-left">
            <div class="brand-header">
                <div class="brand-icon">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="brand-title">VAL<span>RYZE</span></div>
            </div>

            <div class="brand-hero">
                <span class="hero-tag">B2B HR Management Platform</span>
                <h1 class="hero-title">Sistem Produktivitas &amp; SDM yang Efisien</h1>
                <p class="hero-desc">
                    Kelola absensi karyawan berbasis GPS, alur persetujuan cuti &amp; izin, dokumen internal, dan payroll dalam satu platform modern berstandar enterprise.
                </p>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="feature-item-title">Presisi GPS &amp; Geofencing</div>
                            <div class="feature-item-desc">Absensi tervalidasi dengan perimeter radius kantor dan swafoto digital otomatis.</div>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="feature-item-title">Alur Persetujuan Bertingkat</div>
                            <div class="feature-item-desc">Pengajuan cuti, izin, dan lembur terkoordinasi langsung dengan HRD &amp; Manajer divisi.</div>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="feature-item-title">Laporan &amp; Export Real-time</div>
                            <div class="feature-item-desc">Unduh ringkasan presensi, keterlambatan, dan slip gaji dalam format PDF &amp; Excel.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-footer">
                <span>&copy; {{ date('Y') }} VALRYZE. All rights reserved.</span>
                <span>Minimalismo Funcional B2B</span>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="auth-right">
            <div class="login-card">
                <h2 class="form-heading">Masuk ke Portal</h2>
                <p class="form-sub">Gunakan kredensial resmi perusahaan Anda</p>

                @if (session('status'))
                <div style="background: #E3F2FD; border: 1px solid #BBDEFB; color: #007BFF; padding: 0.65rem 0.85rem; border-radius: 4px; font-size: 0.8125rem; margin-bottom: 1.25rem;">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email Kerja</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control" placeholder="nama@perusahaan.com" required autofocus>
                        @error('email')
                        <p style="color: #DC3545; font-size: 0.75rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                            <label for="password" class="form-label" style="margin-bottom: 0;">Password</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.75rem; color: #007BFF; text-decoration: none; font-weight: 500;">Lupa password?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password"
                            class="form-control" placeholder="••••••••" required>
                        @error('password')
                        <p style="color: #DC3545; font-size: 0.75rem; margin-top: 0.35rem; font-weight: 500;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem;">
                        <input type="checkbox" id="remember_me" name="remember" style="accent-color: #007BFF; width: 15px; height: 15px; border-radius: 3px;">
                        <label for="remember_me" style="font-size: 0.8125rem; color: #6C757D; cursor: pointer;">Ingat sesi saya</label>
                    </div>

                    <button type="submit" class="btn-submit">Masuk ke Portal</button>

                    <div class="demo-panel">
                        <div class="demo-title">Akun Uji Coba (Demo)</div>
                        <div class="demo-row">
                            <span class="demo-email">admin@smarthr.com</span>
                            <span class="demo-badge">Super Admin</span>
                        </div>
                        <div class="demo-row">
                            <span class="demo-email">hrd@smarthr.com</span>
                            <span class="demo-badge">HRD</span>
                        </div>
                        <div class="demo-row">
                            <span class="demo-email">manager@smarthr.com</span>
                            <span class="demo-badge">Manager</span>
                        </div>
                        <div class="demo-row">
                            <span class="demo-email">karyawan@smarthr.com</span>
                            <span class="demo-badge">Karyawan</span>
                        </div>
                        <div class="demo-pwd">Password: <code>password</code></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
