<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VALRYZE — Minimalismo Funcional B2B Project & HR Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #FFFFFF;
            --secondary: #F8F8F8;
            --tertiary: #007BFF;
            --neutral: #212529;
            --surface-success: #28A745;
            --accent-warning: #FFC107;
            --error: #DC3545;
            --muted: #6C757D;
            --border: #DEE2E6;
            --border-light: #E9ECEF;
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --shadow-subtle: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--secondary);
            color: var(--neutral);
            min-height: 100dvh;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Sticky Nav (z-index: 100) */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--primary);
            border-bottom: 1px solid var(--border);
            height: 64px;
            display: flex;
            align-items: center;
        }
        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: var(--neutral);
        }
        .brand-icon {
            width: 28px;
            height: 28px;
            background: var(--tertiary);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
        }
        .brand-name {
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }
        .brand-name span { color: var(--tertiary); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav-link {
            text-decoration: none;
            color: var(--muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.15s;
        }
        .nav-link:hover { color: var(--neutral); }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.15s, border-color 0.15s, transform 0.15s;
            border: 1px solid transparent;
        }
        .btn-primary {
            background-color: var(--tertiary);
            color: #FFFFFF;
            padding: 0.65rem 1.25rem;
        }
        .btn-primary:hover {
            background-color: #0069D9;
            transform: translateY(-1px);
        }
        .btn-primary:active { transform: translateY(1px); }

        .btn-secondary {
            background-color: var(--primary);
            color: var(--neutral);
            border: 1.5px solid var(--border);
            padding: 0.65rem 1.25rem;
        }
        .btn-secondary:hover {
            background-color: var(--secondary);
            border-color: #CED4DA;
            transform: translateY(-1px);
        }

        /* Section Gaps */
        .section-gap {
            padding: clamp(4rem, 8vw, 8rem) 0;
        }

        /* Hero Split Screen */
        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 3.5rem;
            align-items: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--tertiary);
            background: rgba(0, 123, 255, 0.08);
            border: 1px solid rgba(0, 123, 255, 0.2);
            padding: 0.25rem 0.65rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.25rem;
        }
        .hero-title {
            font-size: clamp(2.25rem, 4.5vw, 3.5rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.15;
            color: var(--neutral);
            margin-bottom: 1.25rem;
        }
        .hero-desc {
            font-size: 1.125rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 580px;
        }
        .hero-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        .kpi-strip {
            display: flex;
            gap: 2.5rem;
            border-top: 1px solid var(--border);
            padding-top: 1.75rem;
        }
        .kpi-item-val {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--neutral);
            letter-spacing: -0.02em;
        }
        .kpi-item-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 0.2rem;
        }

        /* Hero Preview Mockup */
        .mockup-card {
            background: var(--primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-card);
            padding: 1.5rem;
        }
        .mockup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }
        .mockup-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Zig-Zag Feature Rows */
        .feature-zigzag {
            display: flex;
            flex-direction: column;
            gap: 5rem;
        }
        .zigzag-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        .zigzag-row.reversed {
            direction: rtl;
        }
        .zigzag-row.reversed > * {
            direction: ltr;
        }
        .feature-tag {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--tertiary);
            margin-bottom: 0.75rem;
            display: block;
        }
        .feature-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--neutral);
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 1rem;
        }
        .feature-desc {
            font-size: 1rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .feature-specs {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .spec-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 0.875rem;
            color: var(--neutral);
            font-weight: 500;
        }
        .spec-check {
            width: 18px;
            height: 18px;
            border-radius: var(--radius-sm);
            background: rgba(40, 167, 69, 0.12);
            color: var(--surface-success);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Metric Grid / Data-driven */
        .stats-banner {
            background: var(--neutral);
            color: var(--primary);
            border-radius: var(--radius-sm);
            padding: 3.5rem 2.5rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.03em;
            margin-bottom: 0.35rem;
        }
        .stat-title {
            font-size: 0.875rem;
            color: #ADB5BD;
        }

        /* Footer */
        .footer {
            background: var(--primary);
            border-top: 1px solid var(--border);
            padding: 4rem 0 2rem;
            font-size: 0.875rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        .footer-col-title {
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--neutral);
            margin-bottom: 1rem;
        }
        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .footer-links a {
            text-decoration: none;
            color: var(--muted);
            transition: color 0.15s;
        }
        .footer-links a:hover { color: var(--tertiary); }
        .footer-bottom {
            border-top: 1px solid var(--border-light);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            color: var(--muted);
            font-size: 0.8125rem;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .hero-grid { grid-template-columns: 1fr; }
            .zigzag-row, .zigzag-row.reversed { grid-template-columns: 1fr; gap: 2rem; }
            .zigzag-row.reversed { direction: ltr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
        }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .stats-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .hero-actions { flex-direction: column; align-items: stretch; }
            .kpi-strip { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <!-- Sticky Nav -->
    <header class="navbar">
        <div class="container nav-inner">
            <a href="/" class="brand-logo">
                <div class="brand-icon">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="brand-name">VAL<span>RYZE</span></div>
            </a>

            <nav>
                <ul class="nav-links">
                    <li><a href="#features" class="nav-link">Fitur Utama</a></li>
                    <li><a href="#geofence" class="nav-link">Geofencing GPS</a></li>
                    <li><a href="#workflows" class="nav-link">Persetujuan</a></li>
                    <li><a href="#metrics" class="nav-link">Keandalan</a></li>
                </ul>
            </nav>

            <div style="display: flex; align-items: center; gap: 0.75rem;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Buka Dashboard &rarr;</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Masuk</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Mulai Akses</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section (Split Screen) -->
    <section class="section-gap">
        <div class="container hero-grid">
            <div>
                <span class="hero-badge">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--tertiary);"></span>
                    Minimalismo Funcional B2B &bull; 2026+
                </span>
                <h1 class="hero-title">
                    Manajemen SDM &amp; Operasional Terstruktur
                </h1>
                <p class="hero-desc">
                    Platform presisi untuk manajemen absensi geofencing, alur persetujuan perizinan, administrasi dokumen, dan sistem penggajian dalam satu antarmuka yang bersih.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 0.8rem 1.6rem;">
                        Masuk ke Workspace
                    </a>
                    <a href="#features" class="btn btn-secondary" style="padding: 0.8rem 1.6rem;">
                        Pelajari Arsitektur
                    </a>
                </div>

                <div class="kpi-strip">
                    <div>
                        <div class="kpi-item-val">99.8%</div>
                        <div class="kpi-item-label">Akurasi Validasi Presensi</div>
                    </div>
                    <div>
                        <div class="kpi-item-val">&lt; 2 dtk</div>
                        <div class="kpi-item-label">Waktu Verifikasi Check-In</div>
                    </div>
                    <div>
                        <div class="kpi-item-val">100%</div>
                        <div class="kpi-item-label">Audit Log Aktivitas Terpantau</div>
                    </div>
                </div>
            </div>

            <!-- Visual Preview Card -->
            <div>
                <div class="mockup-card">
                    <div class="mockup-header">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="mockup-dot" style="background: var(--surface-success);"></span>
                            <span style="font-size: 0.8125rem; font-weight: 600; color: var(--neutral);">Monitor Kehadiran Harian</span>
                        </div>
                        <span style="font-size: 0.72rem; font-family: 'JetBrains Mono', monospace; color: var(--muted);">Live Feed</span>
                    </div>

                    <!-- Minimalist Data List -->
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--secondary); border: 1px solid var(--border); border-radius: var(--radius-sm);">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: #FFFFFF; border: 1px solid var(--border); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: var(--tertiary);">
                                    AH
                                </div>
                                <div>
                                    <div style="font-size: 0.8125rem; font-weight: 600;">Ahmad Hanafi</div>
                                    <div style="font-size: 0.72rem; color: var(--muted);">Software Engineer &bull; Divisi IT</div>
                                </div>
                            </div>
                            <span style="font-size: 0.6875rem; font-weight: 600; color: var(--surface-success); background: #E8F5E9; border: 1px solid #C8E6C9; padding: 0.2rem 0.5rem; border-radius: 4px;">
                                Tepat Waktu (07:54)
                            </span>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--secondary); border: 1px solid var(--border); border-radius: var(--radius-sm);">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: #FFFFFF; border: 1px solid var(--border); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: var(--tertiary);">
                                    SN
                                </div>
                                <div>
                                    <div style="font-size: 0.8125rem; font-weight: 600;">Siti Nurhaliza</div>
                                    <div style="font-size: 0.72rem; color: var(--muted);">HR Specialist &bull; People Ops</div>
                                </div>
                            </div>
                            <span style="font-size: 0.6875rem; font-weight: 600; color: var(--surface-success); background: #E8F5E9; border: 1px solid #C8E6C9; padding: 0.2rem 0.5rem; border-radius: 4px;">
                                Tepat Waktu (07:58)
                            </span>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--secondary); border: 1px solid var(--border); border-radius: var(--radius-sm);">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 32px; height: 32px; background: #FFFFFF; border: 1px solid var(--border); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: var(--tertiary);">
                                    BP
                                </div>
                                <div>
                                    <div style="font-size: 0.8125rem; font-weight: 600;">Budi Pratama</div>
                                    <div style="font-size: 0.72rem; color: var(--muted);">Account Executive &bull; Sales</div>
                                </div>
                            </div>
                            <span style="font-size: 0.6875rem; font-weight: 600; color: var(--accent-warning); background: #FFF9C4; border: 1px solid #FFF59D; padding: 0.2rem 0.5rem; border-radius: 4px;">
                                Izin Sakit (Terverifikasi)
                            </span>
                        </div>
                    </div>

                    <div style="margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: var(--muted);">
                        <span>Status Perimeter Geofence</span>
                        <span style="color: var(--surface-success); font-weight: 600;">Aktif &bull; Radius 100m</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zig-Zag Features Section -->
    <section id="features" class="section-gap" style="background: var(--primary); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container feature-zigzag">
            <!-- Row 1: Geofencing -->
            <div id="geofence" class="zigzag-row">
                <div>
                    <span class="feature-tag">Perimeter &amp; Keamanan</span>
                    <h2 class="feature-title">Validasi Absensi Berbasis Geofence Presisi</h2>
                    <p class="feature-desc">
                        Memastikan kehadiran sah hanya ketika karyawan berada dalam koordinat perimeter kantor. Didukung validasi swafoto seketika untuk mencegah kecurangan lokasi.
                    </p>
                    <ul class="feature-specs">
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Penetapan koordinat kantor dan toleransi radius dinamis</span>
                        </li>
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Validasi kamera depan dengan stempel waktu terenkripsi</span>
                        </li>
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Peta pelacakan lokasi riil terintegrasi Google Maps &amp; Leaflet</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="mockup-card" style="background: var(--secondary);">
                        <div style="padding: 1.5rem; border: 1px dashed var(--border); border-radius: var(--radius-sm); text-align: center;">
                            <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin-bottom: 0.5rem;">Sistem Koordinat</div>
                            <div style="font-family: 'JetBrains Mono', monospace; font-size: 1.125rem; font-weight: 600; color: var(--neutral); margin-bottom: 0.5rem;">
                                Lat: -6.2088 &bull; Long: 106.8456
                            </div>
                            <span style="display: inline-block; font-size: 0.75rem; color: var(--surface-success); background: #E8F5E9; border: 1px solid #C8E6C9; padding: 0.2rem 0.6rem; border-radius: 4px; font-weight: 600;">
                                Radius 100m Valid
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Workflows (Reversed) -->
            <div id="workflows" class="zigzag-row reversed">
                <div>
                    <span class="feature-tag">Alur Kerja Digital</span>
                    <h2 class="feature-title">Persetujuan Cuti, Izin, &amp; Lembur Transparan</h2>
                    <p class="feature-desc">
                        Hilangkan formulir fisik. Seluruh pengajuan cuti tahunan, izin sakit, dan jadwal lembur diproses melalui alur persetujuan terstruktur yang dapat dilacak oleh karyawan dan manajemen.
                    </p>
                    <ul class="feature-specs">
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Pemberitahuan otomatis ke manajer dan HRD via notifikasi portal</span>
                        </li>
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Kalkulasi saldo kuota cuti tahunan otomatis</span>
                        </li>
                        <li class="spec-item">
                            <span class="spec-check">&#10003;</span>
                            <span>Pencatatan riwayat audit lengkap pada setiap keputusan persetujuan</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="mockup-card" style="background: var(--secondary);">
                        <div style="padding: 1.5rem; background: var(--primary); border: 1px solid var(--border); border-radius: var(--radius-sm);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <span style="font-size: 0.8125rem; font-weight: 600;">Permohonan Cuti Tahunan</span>
                                <span style="font-size: 0.6875rem; background: #FFF9C4; color: #856404; border: 1px solid #FFF59D; padding: 0.15rem 0.45rem; border-radius: 4px; font-weight: 600;">Menunggu Review</span>
                            </div>
                            <div style="font-size: 0.8125rem; color: var(--muted); margin-bottom: 1rem;">
                                Rencana durasi 3 hari kerja (15 Okt - 17 Okt 2026)
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <button class="btn btn-primary" style="padding: 0.35rem 0.75rem; font-size: 0.75rem;">Setujui</button>
                                <button class="btn btn-secondary" style="padding: 0.35rem 0.75rem; font-size: 0.75rem;">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section id="metrics" class="section-gap">
        <div class="container">
            <div class="stats-banner">
                <div class="stats-grid">
                    <div>
                        <div class="stat-number">100%</div>
                        <div class="stat-title">Transparansi Audit Log</div>
                    </div>
                    <div>
                        <div class="stat-number">5x</div>
                        <div class="stat-title">Efisiensi Proses Persetujuan</div>
                    </div>
                    <div>
                        <div class="stat-number">0 Min</div>
                        <div class="stat-title">Waktu Rekapitulasi Manual</div>
                    </div>
                    <div>
                        <div class="stat-number">24/7</div>
                        <div class="stat-title">Ketersediaan Sistem Operasional</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="brand-logo" style="margin-bottom: 1rem;">
                        <div class="brand-icon">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="brand-name">VAL<span>RYZE</span></div>
                    </div>
                    <p style="font-size: 0.875rem; color: var(--muted); max-width: 320px; line-height: 1.6;">
                        Minimalismo Funcional B2B platform untuk manajemen SDM, absensi geofencing, persetujuan kerja, dan administrasi digital.
                    </p>
                </div>

                <div>
                    <div class="footer-col-title">Modul Utama</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">Absensi GPS &amp; Selfie</a></li>
                        <li><a href="{{ route('login') }}">Manajemen Cuti &amp; Izin</a></li>
                        <li><a href="{{ route('login') }}">Lembur &amp; Jadwal Shift</a></li>
                        <li><a href="{{ route('login') }}">Slip Gaji &amp; Payroll</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-col-title">Keandalan</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">Geofence Perimeter</a></li>
                        <li><a href="{{ route('login') }}">Audit Trail &amp; Log</a></li>
                        <li><a href="{{ route('login') }}">Role &amp; Permissions</a></li>
                        <li><a href="{{ route('login') }}">Ekspor PDF &amp; Excel</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-col-title">Akses Cepat</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">Masuk Akun</a></li>
                        <li><a href="{{ route('login') }}">Dokumentasi</a></li>
                        <li><a href="{{ route('login') }}">Hubungi Administrator</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} VALRYZE. Minimalismo Funcional B2B. All rights reserved.</span>
                <span>Standar Operasional Digital Enterprise</span>
            </div>
        </div>
    </footer>
</body>
</html>
