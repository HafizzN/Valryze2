# BUKU PANDUAN LENGKAP & PEDOMAN OPERASIONAL SISTEM (STANDARD OPERATING PROCEDURE)
## PORTAL MANAJEMEN SDM & PRESENSI DIGITAL — VALRYZE
**Versi Sistem:** v1.0.0 Enterprise Edition  
**Dokumentasi Terakhir:** Oktober 2026  
**Status Sistem:** Production Ready & Security Hardened

---

## DAFTAR ISI
1. [PENDAHULUAN & ARSITEKTUR SISTEM](#1-pendahuluan--arsitektur-sistem)
   * 1.1 Mengenai VALRYZE HR Portal
   * 1.2 Filosofi Desain (Minimalismo Funcional B2B)
   * 1.3 Spesifikasi Teknologi Pendukung
   * 1.4 Matriks Peran Pengguna (Role-Based Access Control)
2. [MANAJEMEN AKUN & ALUR AUTENTIKASI](#2-manajemen-akun--alur-autentikasi)
   * 2.1 Masuk Sistem (Login)
   * 2.2 Lupa & Reset Kata Sandi
   * 2.3 Profil Pengguna & Ganti Foto Profil
   * 2.4 Keluar Sistem (Logout) & Manajemen Sesi
3. [PANDUAN OPERASIONAL DASHBOARD](#3-panduan-operasional-dashboard)
   * 3.1 Dashboard Super Admin & HRD
   * 3.2 Dashboard Manager (Kepala Divisi)
   * 3.3 Dashboard Karyawan (Staff)
   * 3.4 Fitur Pencarian Global (Global Search)
   * 3.5 Sistem Notifikasi & Bell Icon
4. [MODUL PRESENSI, SHIFT, & GEOFENCING (ATTENDANCE)](#4-modul-presensi-shift--geofencing-attendance)
   * 4.1 Prinsip Kerja & Validasi Presensi
   * 4.2 Prosedur Absen Masuk (Check-In)
   * 4.3 Prosedur Absen Pulang (Check-Out)
   * 4.4 Riwayat Absensi Pribadi
   * 4.5 Aturan & Logika Shift Kerja (Shift Pagi, Siang, Malam/Overnight)
   * 4.6 Mekanisme Anti-Kecurangan (Fake GPS & Geofence Guard)
5. [MODUL PERIZINAN, CUTI, & LEMBUR (LEAVE & PERMITS)](#5-modul-perizinan-cuti--lembur-leave--permits)
   * 5.1 Permohonan Cuti (Leave Request)
   * 5.2 Permohonan Izin Keterlambatan / Tidak Masuk (Permission Request)
   * 5.3 Permohonan Lembur (Overtime Request)
   * 5.4 Alur Verifikasi & Persetujuan Berjenjang (Approval Workflow)
6. [MODUL PERSURATAN & DOKUMEN BERSAMA (LETTERS & DOCUMENTS)](#6-modul-persuratan--dokumen-bersama-letters--documents)
   * 6.1 Permohonan Surat Resmi (Surat Tugas, Surat Keterangan, dll)
   * 6.2 Repositori Dokumen Perusahaan (SOP & Kebijakan)
   * 6.3 Pengumuman & Memo Kantor (Announcements)
7. [MODUL MANAJEMEN KARYAWAN (EMPLOYEE MANAGEMENT)](#7-modul-manajemen-karyawan-employee-management)
   * 7.1 Direktori Data Karyawan
   * 7.2 Prosedur Pendaftaran Karyawan Baru
   * 7.3 Pembaruan Data & Mutasi Jabatan
   * 7.4 Penonaktifan Akun (Offboarding / Resign)
8. [MODUL PENGGAJIAN (PAYROLL MANAGEMENT)](#8-modul-penggajian-payroll-management)
   * 8.1 Struktur Komponen Gaji Karyawan
   * 8.2 Konfigurasi Gaji Pokok & Tunjangan
   * 8.3 Pemotongan Iuran BPJS & Pajak PPh 21
   * 8.4 Kalkulasi Gaji Bersih (Take Home Pay)
9. [MODUL MASTER DATA](#9-modul-master-data)
   * 9.1 Master Divisi
   * 9.2 Master Jabatan (Position)
   * 9.3 Master Shift Kerja
   * 9.4 Master Titik Lokasi Kantor (Geofence Coordinate)
10. [MODUL KALENDER & AGENDA KERJA (CALENDAR)](#10-modul-kalender--agenda-kerja-calendar)
   * 10.1 Kalender Terpadu & Jadwal Shift
   * 10.2 Manajemen Hari Libur Nasional & Cuti Bersama
11. [MODUL PELAPORAN & EKSPOR DATA (REPORTS & ANALYTICS)](#11-modul-pelaporan--ekspor-data-reports--analytics)
   * 11.1 Laporan Rekapitulasi Presensi
   * 11.2 Laporan Keterlambatan (Lateness Report)
   * 11.3 Laporan Penggunaan Cuti & Izin
   * 11.4 Peta Sebaran Lokasi GPS Presensi
   * 11.5 Prosedur Ekspor Data ke Spreadsheet (Excel/CSV)
12. [MODUL ADMINISTRASI SISTEM & AUDIT LOGS (SETTINGS)](#12-modul-administrasi-sistem--audit-logs-settings)
   * 12.1 Konfigurasi Organisasi & Upload Logo Perusahaan
   * 12.2 Manajemen Hak Akses Pengguna (User Management)
   * 12.3 Jejak Audit Aktivitas (Audit Trail & Activity Logs)
13. [PANDUAN OPERASIONAL APLIKASI MOBILE (FLUTTER)](#13-panduan-operasional-aplikasi-mobile-flutter)
   * 13.1 Persyaratan Perangkat Keras & Lunak
   * 13.2 Presensi Mobile dengan Swafoto & GPS
   * 13.3 Penanganan Kendala Mock Location (Fake GPS)
14. [STANDAR KEAMANAN, MONITORING, & TROUBLESHOOTING](#14-standar-keamanan-monitoring--troubleshooting)
   * 14.1 Proteksi Keamanan Backend & API
   * 14.2 Panduan Menjalankan Web Server Mandiri
   * 14.3 Tabel Solusi Permasalahan Teknis (Troubleshooting FAQ)

---

## 1. PENDAHULUAN & ARSITEKTUR SISTEM

### 1.1 Mengenai VALRYZE HR Portal
VALRYZE HR Portal adalah platform komprehensif *Human Resource Information System* (HRIS) dan sistem presensi terpadu yang dirancang untuk menjawab kebutuhan operasional bisnis modern. Sistem ini memadukan kemudahan penggunaan antarmuka web dengan mobilitas aplikasi smartphone, sekaligus mengimplementasikan validasi lokasi presisi tinggi dan audit keamanan data.

### 1.2 Filosofi Desain (Minimalismo Funcional B2B)
Antarmuka pengguna (UI) dibangun dengan standar **Minimalismo Funcional B2B (Era 2026+)**:
* **Bebas Distraksi**: Menghilangkan efek glow neon, gradien berlebihan, dan elemen dekoratif non-fungsional.
* **Tipografi Bersih**: Menggunakan font sans-serif **Inter** (bobot 400, 500, 600, 700) untuk teks bacaan dan **JetBrains Mono** untuk representasi angka teknis, jam kerja, dan NIK.
* **Palet Warna Semantik**:
  * Surface Utama: `#FFFFFF` (Putih Bersih)
  * Background Halaman: `#F8F8F8` (Abu Lembut)
  * Teks Utama: `#212529` (Hitam Pekat Charcoal) & `#6C757D` (Abu Teks Redup)
  * Aksen Utama: `#007BFF` (Biru Korporat B2B)
  * Status Sukses: `#28A745` (Hijau)
  * Status Peringatan: `#FFC107` (Kuning Amber)
  * Status Bahaya / Ditolak: `#DC3545` (Merah Lembut)
* **Konsistensi Radius**: Seluruh kartu (*cards*), tombol (*buttons*), form input, dan modal menggunakan border radius **4px** (`rounded-sm`).

### 1.3 Spesifikasi Teknologi Pendukung
* **Framework Backend**: Laravel 11.x (PHP 8.2) dengan struktur keamanan terkini.
* **Basis Data**: SQLite / MySQL dengan relasi terindeks dan proteksi integritas *foreign key*.
* **Frontend Web**: Laravel Blade Engine, Vite v7.3, Tailwind CSS v3.4, Alpine.js v3, Chart.js.
* **Aplikasi Mobile**: Flutter SDK (Dart) dengan arsitektur RESTful API token-based.
* **Penyimpanan Berkas**: Storage Link disk publik (`D:\Portal\public\storage` terhubung ke `D:\Portal\storage\app/public`).

### 1.4 Matriks Peran Pengguna (Role-Based Access Control)

| Menu / Fitur | Super Admin | HRD | Manager | Karyawan |
| :--- | :---: | :---: | :---: | :---: |
| **Dashboard** | Full Admin | Full Admin | Tim Manager | Karyawan |
| **Absen Masuk & Pulang** | Ya | Ya | Ya | Ya |
| **Riwayat Presensi Pribadi** | Ya | Ya | Ya | Ya |
| **Pengajuan Cuti, Izin, Lembur** | Ya | Ya | Ya | Ya |
| **Approval Cuti / Izin / Lembur** | Ya | Ya (Final) | Ya (Divisi) | Tidak |
| **Permohonan Surat Dinas** | Ya | Ya (Proses) | Ya (Review) | Ya (Ajukan) |
| **Download SOP & Dokumen** | Ya | Ya | Ya | Ya |
| **Upload Dokumen Perusahaan** | **Ya** | **Ya** | Tidak | Tidak |
| **Manajemen Karyawan** | **Ya** | **Ya** | Tidak | Tidak |
| **Master Data (Shift, Lokasi, dll)** | **Ya** | **Ya** | Tidak | Tidak |
| **Manajemen Payroll** | **Ya** | **Ya** | Review | Tidak |
| **Laporan & Ekspor Data** | **Ya** | **Ya** | Divisi | Tidak |
| **Profil Perusahaan & Logo** | **Ya** | Tidak | Tidak | Tidak |
| **User Management & Audit Logs** | **Ya** | Tidak | Tidak | Tidak |

---

## 2. MANAJEMEN AKUN & ALUR AUTENTIKASI

### 2.1 Masuk Sistem (Login)
1. Buka browser web dan arahkan ke alamat URL: `http://127.0.0.1:8000/login`.
2. Halaman menampilkan form minimalis split-screen.
3. Masukkan **Alamat Email** dan **Kata Sandi**.
4. *(Opsional)* Centang **Ingat Saya (Remember Me)** untuk mempertahankan sesi browser.
5. Klik tombol **Masuk ke Portal**.
6. Sistem memverifikasi kecocokan kredensial dan status keaktifan akun. Akun dengan status *inactive* akan otomatis ditolak masuk.

> **Proteksi Keamanan (Brute-Force Protection):**  
> Form login diproteksi oleh rate limiter `throttle:10,1`. Jika terjadi kesalahan input password sebanyak 10 kali dalam kurun waktu 1 menit, IP pengguna akan dikunci sementara selama 60 detik.

### 2.2 Lupa & Reset Kata Sandi
1. Pada form login, klik tautan **Lupa Kata Sandi?** (`/forgot-password`).
2. Masukkan alamat email yang terdaftar pada sistem.
3. Klik tombol **Kirim Tautan Reset Password**.
4. Sistem akan mengirimkan tautan dengan token kriptografi satu kali pakai (*one-time token*) ke email tersebut.
5. Buka email, klik tautan, lalu buat kata sandi baru (minimal 8 karakter kombinasi huruf dan angka).

### 2.3 Profil Pengguna & Ganti Foto Profil
1. Klik avatar akun Anda pada pojok kanan atas topbar, kemudian pilih **Profil Saya** (`/profile`).
2. **Informasi Akun**: Anda dapat memperbarui Nama Lengkap, Alamat Email, Nomor Telepon, dan Alamat Rumah.
3. **Foto Profil**: Unggah foto resmi berformat JPG atau PNG (maksimal 2MB). Foto ini akan digunakan sebagai foto profil akun dan identitas di aplikasi mobile.
4. **Perbarui Kata Sandi**: Masukkan kata sandi saat ini, diikuti kata sandi baru dan konfirmasi kata sandi baru.
5. Klik tombol **Simpan Perubahan**.

### 2.4 Keluar Sistem (Logout) & Manajemen Sesi
* Klik avatar profil di topbar dan pilih tombol merah **Keluar**.
* Sesi autentikasi web akan dihapus secara menyeluruh, token CSRF di-*regenerate*, dan browser diarahkan kembali ke halaman login.

---

## 3. PANDUAN OPERASIONAL DASHBOARD

### 3.1 Dashboard Super Admin & HRD (`/dashboard`)
* **Banner Selamat Datang (Hero Section)**:
  - Menyapa nama pengguna, tanggal hari ini, dan peran aktif.
  - Kartu indikator cincin (*donut ring chart*) yang menampilkan persentase tingkat kehadiran karyawan hari ini secara real-time.
  - Status pill: Jumlah hadir, jumlah permohonan pending, dan jumlah absensi absen/alpha.
* **AI Insight Sidebar**:
  - Algoritma analitik cerdas yang otomatis mendeteksi anomali kehadiran (misal: karyawan yang terlambat berulang, karyawan yang sedang cuti resmi, atau stabilitas kehadiran tim).
* **Grafik Tren Kehadiran Mingguan (Weekly Attendance Area Chart)**:
  - Grafik interaktif Chart.js dengan kurva biru (`#007BFF`) untuk karyawan hadir tepat waktu dan kurva kuning (`#FFC107`) untuk karyawan terlambat.
* **Tabel Absensi Real-Time**:
  - Menampilkan baris kehadiran terbaru hari ini lengkap dengan nama, divisi, jam masuk, jam pulang, dan badge status.
* **Pengumuman Kantor**:
  - Menampilkan daftar memo atau edaran manajemen terbaru lengkap dengan tanggal publikasi dan tag *PENTING*.

### 3.2 Dashboard Manager (Kepala Divisi)
* **Team Health Card**:
  - Menampilkan metrik produktivitas divisi yang dipimpin manager bersangkutan.
  - Menghitung persentase kehadiran tim hari ini, jumlah anggota aktif divisi, dan anggota yang sedang cuti/dinas.
* **Pending Approvals Box**:
  - Kotak peringatan aksi darurat berwarna merah lembut jika ada bawahan yang mengajukan cuti, izin, atau lembur yang belum diproses.
* **Tabel Presensi Divisi**:
  - Memantau kepatuhan jam kerja karyawan di unit kerja terkait.

### 3.3 Dashboard Karyawan (Staff)
* **Status Kehadiran Hari Ini**:
  - Menampilkan jam check-in aktif dan nama shift kerja yang diambil.
  - Badge dinamis: *Hadir Tepat Waktu*, *Terlambat X Menit*, atau *Sudah Pulang*.
* **Tombol Aksi Cepat**:
  - Tombol biru **Absen Masuk Sekarang** (jika belum presensi).
  - Tombol kuning **Absen Pulang** (jika telah selesai jam kerja).
  - Kartu hijau **Hari ini selesai ✓** (jika sudah lengkap check-in dan check-out).
* **Kartu Statistik Pribadi**:
  - Total kehadiran bulan ini.
  - Sisa kuota cuti tahunan (default: 12 hari dikurangi cuti terpakai).
  - Persentase ketepatan waktu (*on-time rate*).

### 3.4 Fitur Pencarian Global (Global Search)
* Terletak di tengah topbar navigasi (`input search`).
* Ketikkan minimal 2 karakter (misal: nama karyawan, divisi, judul cuti, atau memo).
* Sistem melakukan pencarian instan secara asinkron (*debounce 300ms*) dan menampilkan dropdown hasil pencarian yang dapat langsung diklik.

### 3.5 Sistem Notifikasi & Bell Icon
* Ikon lonceng pada topbar menampilkan badge merah berisi jumlah notifikasi yang belum dibaca.
* Klik ikon lonceng untuk melihat pratinjau 5 notifikasi terbaru (misal: "Pengajuan Cuti Disetujui", "Pengumuman Baru Diterbitkan").
* Tersedia tombol **Tandai dibaca** atau **Lihat semua** (`/notifications`).

---

## 4. MODUL PRESENSI, SHIFT, & GEOFENCING (ATTENDANCE)

### 4.1 Prinsip Kerja & Validasi Presensi
Untuk menjamin validitas dan integritas data kehadiran, sistem menerapkan 4 pilar pengaman:
1. **Jendela Waktu Shift**: Tombol absensi masuk dibuka mulai **60 menit sebelum jam shift dimulai** hingga jam shift berakhir.
2. **Validasi Radius Geofencing**: Perangkat pengguna wajib berada dalam jarak koordinat toleransi kantor (diukur menggunakan formula *Haversine* akurat).
3. **Pemeriksaan Mock Location (Fake GPS)**: Menolak sinyal lokasi buatan pihak ketiga.
4. **Swafoto Biometrik**: Setiap presensi wajib menyertakan foto wajah aktual karyawan di lokasi kerja.

### 4.2 Prosedur Absen Masuk (Check-In)
1. Akses menu **Attendance › Absen Masuk** (`/attendance/check-in`).
2. Peramban meminta izin akses kamera dan lokasi; klik **Izinkan / Allow**.
3. Pilih shift kerja yang Anda jalani hari ini pada menu dropdown.
4. Periksa indikator status lokasi di layar:
   - **Hijau**: "Lokasi Valid - Anda berada di dalam area kantor (X meter dari titik kantor)".
   - **Merah**: "Lokasi di luar jangkauan (X meter dari batas izin kantor)".
5. Posisikan wajah Anda pada lingkaran kamera lalu ambil foto.
6. Klik tombol biru **KIRIM ABSEN MASUK**.
7. Sistem mencatat jam masuk secara presisi waktu server (WIB) dan menentukan status apakah Hadir atau Terlambat.

### 4.3 Prosedur Absen Pulang (Check-Out)
1. Akses menu **Attendance › Absen Pulang** (`/attendance/check-out`).
2. Layar menampilkan informasi jam masuk yang telah tercatat sebelumnya.
3. Ambil swafoto kepulangan di area kerja.
4. Klik tombol hijau **KIRIM ABSEN PULANG**.
5. Sistem menutup sesi kerja dan otomatis mengalkulasi total durasi kerja hari tersebut.

### 4.4 Riwayat Absensi Pribadi (`/attendance/history`)
* Menampilkan daftar kehadiran per bulan.
* Karyawan dapat memfilter berdasarkan bulan dan tahun untuk melihat:
  - Tanggal kerja.
  - Jam masuk dan jam pulang.
  - Status kehadiran (*Hadir, Terlambat, Izin, Cuti, Sakit, Alpha*).
  - Tautan foto bukti kehadiran yang tersimpan di server.

### 4.5 Aturan & Logika Shift Kerja
* **Shift Standar (Normal Shift)**: Shift satu hari kalender (misal: 08:00 WIB s/d 17:00 WIB).
* **Shift Malam / Bermalam (Overnight Shift)**: Shift yang melintasi tengah malam (misal: Mulai 22:00 WIB hari ini dan Selesai 06:00 WIB keesokan harinya). Sistem secara otomatis mengaitkan sesi pulang ke tanggal sesi masuk hari sebelumnya tanpa menimbulkan anomali data ganda.
* **Toleransi Keterlambatan**: Admin dapat menentukan batas menit dispensasi keterlambatan (misal: 15 menit). Jika shift dimulai jam 08:00 dan toleransi 15 menit, maka absensi jam 08:14 tetap dianggap tepat waktu.

### 4.6 Mekanisme Anti-Kecurangan (Anti-Fraud)
* **Pencegahan Absen Ganda**: Karyawan tidak dapat melakukan check-in baru sebelum melakukan check-out pada sesi shift sebelumnya.
* **Penguncian Bypass Parameter**: Fitur pengujian `bypass_restrictions` terkunci ketat hanya untuk akun Super Admin/HRD. Akses manipulasi dari sisi browser klien karyawan otomatis ditolak dengan pesan error HTTP 400/403.

---

## 5. MODUL PERIZINAN, CUTI, & LEMBUR (LEAVE & PERMITS)

### 5.1 Permohonan Cuti (Leave Request)
1. Buka menu **Leave & Permits › Cuti** (`/leave`).
2. Halaman menampilkan rekapitulasi kuota cuti tahunan, cuti terpakai, dan riwayat cuti sebelumnya.
3. Klik tombol **Ajukan Cuti** (`/leave/create`).
4. Lengkapi isian form:
   - **Kategori Cuti**: Cuti Tahunan (*Annual Leave*), Cuti Sakit (*Sick Leave*), Cuti Bersalin (*Maternity*), atau Cuti Alasan Penting.
   - **Tanggal Mulai** dan **Tanggal Selesai**.
   - **Alasan Pengajuan Cuti**: Penjelasan keperluan cuti.
   - **Lampiran Dokumen**: Wajib untuk cuti sakit (surat keterangan dokter/rumah sakit, format PDF/JPG maks. 2MB).
5. Klik **Kirim Pengajuan Cuti**.

### 5.2 Permohonan Izin Keterlambatan / Tidak Masuk (Permission Request)
1. Buka menu **Leave & Permits › Izin** (`/permission`).
2. Klik **Ajukan Izin** (`/permission/create`).
3. Tentukan jenis izin:
   - Izin Datang Terlambat (beserta estimasi jam tiba).
   - Izin Pulang Lebih Awal.
   - Izin Tidak Masuk Kerja Harian.
4. Masukkan tanggal dan uraian keterangan keperluan.
5. Klik **Kirim Permohonan Izin**.

### 5.3 Permohonan Lembur (Overtime Request)
1. Buka menu **Leave & Permits › Lembur** (`/overtime`).
2. Klik **Ajukan Lembur** (`/overtime/create`).
3. Tentukan tanggal lembur, jam mulai kerja lembur, dan jam estimasi berakhir.
4. Jelaskan target pekerjaan (*deliverables*) yang diselesaikan selama jam lembur.
5. Klik **Kirim Pengajuan Lembur**.

### 5.4 Alur Verifikasi & Persetujuan Berjenjang (Approval Workflow)
1. **Inbox Approval Manager**: Setiap pengajuan bawahan otomatis muncul di dashboard dan menu perizinan Manager divisi yang bersangkutan.
2. **Pemeriksaan Data**: Manager meninjau urgensi, sisa kuota, dan lampiran berkas.
3. **Tindakan Persetujuan**:
   - **Setujui (Approve)**: Permohonan berlanjut ke tahap pengesahan.
   - **Tolak (Reject)**: Manager wajib mengisikan catatan/alasan penolakan.
4. **Verifikasi HRD untuk Lembur**: Pengajuan lembur memiliki fitur approval bertingkat (*Approve Manager* kemudian divalidasi oleh *Approve HRD*) guna memastikan kepatuhan kalkulasi uang lembur pada laporan payroll bulanan.

---

## 6. MODUL PERSURATAN & DOKUMEN BERSAMA (LETTERS & DOCUMENTS)

### 6.1 Permohonan Surat Resmi (Letters)
1. Buka menu **Dokumen › Surat Menyurat** (`/letters`).
2. Karyawan dapat mengajukan pembuatan surat dinas resmi ke divisi personalia:
   - Surat Keterangan Kerja (untuk keperluan KPR, bank, atau visa).
   - Surat Tugas Dinas Luar Kota.
   - Surat Pengantar Rekomendasi.
3. HRD memproses draf surat, mencantumkan nomor surat resmi, membubuhkan tanda tangan digital/stempel, lalu mengunggah file final PDF.
4. Karyawan menerima notifikasi dan dapat mengunduh surat resmi langsung melalui tombol **Download Surat** (`/letters/{id}/download`).

### 6.2 Repositori Dokumen Perusahaan (SOP & Kebijakan)
1. Buka menu **Dokumen › File Bersama** (`/documents`).
2. Berfungsi sebagai pusat penyimpanan (*cloud repository*) berkas pedoman kerja bersama:
   - Standar Operasional Prosedur (SOP Divisi).
   - Buku Pedoman Peraturan Perusahaan (Company Regulation).
   - Template Form Formulir Standar Kantor.
   - Keputusan Direksi (SK Organisasi).
3. **Hak Akses Keamanan**:
   - Hanya **Super Admin** dan **HRD** yang memiliki wewenang mengunggah (`/documents/create`), mengedit, dan menghapus dokumen.
   - Seluruh karyawan dapat melihat daftar dan mengunduh berkas (`/documents/{id}/download`).

### 6.3 Pengumuman & Memo Kantor (Announcements)
1. Buka menu **Dokumen › Pengumuman** (`/announcements`).
2. Digunakan HRD dan Manajemen untuk mempublikasikan berita internal, edaran libur bersama, atau memo mutasi.
3. Memo penting dapat disematkan (*Pin Announcement*) sehingga selalu berada di urutan teratas pada seluruh dasbor pengguna.

---

## 7. MODUL MANAJEMEN KARYAWAN (EMPLOYEE MANAGEMENT)

*(Khusus Super Admin & HRD — `/employees`)*

### 7.1 Direktori Data Karyawan
* Menampilkan daftar seluruh karyawan terdaftar dalam format tabel data responsif.
* Dilengkapi filter pencarian berdasarkan nama, NIK, divisi kerja, status kepegawaian, dan status keaktifan akun.

### 7.2 Prosedur Pendaftaran Karyawan Baru
1. Pada halaman data karyawan, klik tombol **Tambah Karyawan Baru** (`/employees/create`).
2. Lengkapi formulir pendaftaran yang terbagi dalam blok data:
   * **Identitas Diri**: Nama Lengkap, Nomor Induk Karyawan (NIK), Email Kantor, Nomor Handphone/WhatsApp, Jenis Kelamin, Tanggal Lahir, Alamat Tempat Tinggal.
   * **Struktur Organisasi**: Pilih Divisi Kerja, Jabatan (*Position*), dan Shift Kerja Utama.
   * **Status Kepegawaian**: Pilih jenis kontrak (*Permanent, Contract, Internship, Freelance*).
   * **Kompensasi Awal**: Masukkan nilai Gaji Pokok, Tunjangan Tetap, dan Kuota Cuti Tahunan (standar: 12 hari).
   * **Kredensial Akun**: Tetapkan kata sandi awal akun dan pilih Hak Akses Peran (*Role: Karyawan, Manager, atau HRD*).
3. Klik tombol **Simpan Data Karyawan**. Akun baru langsung aktif dan dapat digunakan untuk login.

### 7.3 Pembaruan Data & Mutasi Jabatan
* Klik tombol **Edit** pada baris karyawan bersangkutan (`/employees/{id}/edit`).
* Perbarui data yang diperlukan (misal: penyesuaian gaji berkala, perubahan divisi mutasi kerja, atau promosi jabatan).
* Klik **Simpan Perubahan**.

### 7.4 Penonaktifan Akun (Offboarding / Resign)
* Jika karyawan berhenti bekerja, ubah status karyawan menjadi **Nonaktif (Inactive)**.
* Akun yang dinonaktifkan tidak akan dapat login lagi ke portal web maupun API mobile, namun seluruh rekam jejak presensi, berkas surat, dan riwayat gaji masa lalunya tetap tersimpan permanen untuk keperluan pelaporan dan audit.

---

## 8. MODUL PENGGAJIAN (PAYROLL MANAGEMENT)

*(Akses: HRD & Super Admin — `/payroll`)*

### 8.1 Struktur Komponen Gaji Karyawan
Sistem mengalkulasi kompensasi karyawan berdasarkan 4 pilar komponen:
1. **Gaji Pokok (Basic Salary)**: Imbalan dasar yang disepakati dalam kontrak kerja.
2. **Tunjangan Tetap (Allowance)**: Tunjangan jabatan, makan, atau transportasi.
3. **Potongan Iuran BPJS**: Iuran jaminan kesehatan dan ketenagakerjaan.
4. **Potongan Pajak Penghasilan (PPh 21)**: Potongan pajak penghasilan sesuai ketentuan perpajakan.

### 8.2 Konfigurasi Nilai Kompensasi
1. Masuk ke menu **Payroll** (`/payroll`).
2. Cari nama karyawan yang ingin disesuaikan nilainya.
3. Klik tombol **Edit Gaji** (`/payroll/{id}/edit`).
4. Masukkan nominal angka pada kolom input:
   - Gaji Pokok (Rp).
   - Tunjangan Tetap (Rp).
   - Potongan BPJS (Rp).
   - Potongan PPh 21 (Rp).
5. Klik tombol **Simpan Pengaturan Payroll**.

### 8.3 Formula Kalkulasi Gaji Bersih (Take Home Pay)
Sistem menggunakan formula standar:
$$\text{Take Home Pay (THP)} = (\text{Gaji Pokok} + \text{Tunjangan}) - (\text{Potongan BPJS} + \text{Potongan PPh 21})$$

Data ini terintegrasi langsung dengan rekap kehadiran bulanan untuk menghasilkan laporan penggajian yang akurat.

---

## 9. MODUL MASTER DATA

*(Khusus Super Admin & HRD — `/master`)*

### 9.1 Master Divisi (`/master/divisions`)
* Mengelola departemen atau divisi operasional perusahaan.
* Kolom data: Nama Divisi, Kode Divisi, dan Kepala Divisi (Manager Penanggung Jawab).

### 9.2 Master Jabatan (`/master/positions`)
* Mengelola hierarki jabatan dalam organisasi (misal: Staff, Supervisor, Senior Lead, Head of Department).
* Kolom data: Nama Jabatan dan Kategori Golongan.

### 9.3 Master Shift Kerja (`/master/shifts`)
* Mengelola jam kerja operasional:
  * **Nama Shift**: Misal: Shift Pagi Kantor, Shift Operasional Gudang, Shift Night Patrol.
  * **Jam Mulai & Jam Selesai**: Misal: 08:00 WIB - 17:00 WIB.
  * **Shift Bermalam (Overnight)**: Aktifkan jika jam shift melewati pukul 00:00 tengah malam.
  * **Toleransi Keterlambatan (Late Tolerance)**: Menit batas toleransi (misal: 15 menit).
  * **Status Aktif**: Mengaktifkan atau menonaktifkan shift dari opsi pilihan presensi karyawan.

### 9.4 Master Titik Lokasi Kantor (`/master/locations`)
* Menentukan koordinat geofencing absensi:
  * **Nama Titik**: Misal: Kantor Pusat Jakarta, Cabang Bandung, Gudang Logistik Cikarang.
  * **Titik Koordinat Latitude & Longitude**: Salin koordinat desimal dari peta (misal: `-6.2088, 106.8456`).
  * **Radius Toleransi (Meter)**: Jarak radius lingkaran geofence yang diizinkan (standar rekomendasi: 50 s/d 150 meter).
  * **Alamat Lengkap Kantor**: Alamat fisik lokasi kerja.

---

## 10. MODUL KALENDER & AGENDA KERJA (CALENDAR)

*(Akses: Seluruh Pengguna — `/calendar`)*

### 10.1 Kalender Terpadu & Jadwal Shift
* Menampilkan kalender visual interaktif dalam skala bulanan.
* Memetakan jadwal kehadiran karyawan, cuti yang telah disetujui, serta agenda kegiatan bersama perusahaan.

### 10.2 Manajemen Hari Libur Nasional & Cuti Bersama
1. Buka menu **Kalender** dan klik **Tambah Agenda / Hari Libur** (`/calendar`).
2. Masukkan judul hari libur (misal: "Hari Raya Idul Fitri", "Tahun Baru Masehi").
3. Pilih rentang tanggal libur.
4. Centang **Hari Libur Resmi Kantor**.
5. Klik **Simpan**. Sistem otomatis menandai hari tersebut sebagai hari libur non-kerja, sehingga karyawan tidak dihitung alpha pada tanggal tersebut.

---

## 11. MODUL PELAPORAN & EKSPOR DATA (REPORTS & ANALYTICS)

*(Akses: Super Admin, HRD, & Manager — `/reports`)*

### 11.1 Laporan Rekapitulasi Presensi (`/reports/attendance`)
* Menampilkan matriks rekap kehadiran seluruh karyawan.
* Filter data: Rentang Tanggal (Harian / Mingguan / Bulanan), Divisi Kerja, dan Status Kehadiran (*Present, Late, Absent, Leave, Sick, Permission*).

### 11.2 Laporan Keterlambatan (`/reports/lateness`)
* Menganalisis tingkat kepatuhan jam kerja karyawan.
* Menampilkan daftar akumulasi menit keterlambatan, frekuensi terlambat dalam sebulan, dan perbandingan performa ketepatan waktu antar divisi.

### 11.3 Laporan Penggunaan Cuti & Izin (`/reports/leave`)
* Menyajikan ringkasan saldo cuti tahunan yang tersisa untuk setiap karyawan serta rekam jejak persetujuan cuti yang telah diterbitkan.

### 11.4 Peta Sebaran Lokasi GPS Presensi (`/reports/gps`)
* Menampilkan peta digital interaktif yang memetakan pin titik lokasi koordinat karyawan saat menekan tombol absen masuk dan absen pulang, memudahkan audit kepatuhan lokasi kerja lapangan.

### 11.5 Prosedur Ekspor Data ke Spreadsheet (Excel / CSV)
1. Buka halaman **Laporan Absen** (`/reports/attendance`).
2. Terapkan filter periode tanggal dan divisi yang ingin diekspor.
3. Klik tombol **Ekspor** pada bagian atas layar (`/reports/attendance/export`).
4. File spreadsheet berformat `.csv` atau `.xlsx` akan langsung terunduh ke komputer Anda dan siap diintegrasikan dengan laporan manajemen.

---

## 12. MODUL ADMINISTRASI SISTEM & AUDIT LOGS (SETTINGS)

*(Khusus Super Admin — `/settings`)*

### 12.1 Konfigurasi Organisasi & Upload Logo Perusahaan (`/settings/company`)
1. Akses menu **Settings › Profil Kantor**.
2. **Formulir Profil Identitas**:
   * Nama Resmi Perusahaan (misal: *PT. Smart Teknologi Indonesia*).
   * Website Resmi Perusahaan.
   * Nomor Pokok Wajib Pajak (NPWP).
   * Nomor Induk Berusaha (NIB) / Izin Usaha.
   * Nomor Telepon & Email Resmi Kantor.
   * Alamat Lengkap Domisili Perusahaan.
   * Radius Geofence Default (Meter).
3. **Prosedur Penggantian Logo Perusahaan**:
   * Pada baris **Unggah Logo Perusahaan Baru**, klik tombol **Choose File / Telusuri**.
   * Pilih berkas logo (format didukung: PNG, JPG, WEBP, SVG, maksimal 2MB).
   * Tinjau kotak pratinjau instan (*live preview*) di sisi kiri untuk memastikan logo tampil proporsional.
   * Klik tombol biru **Simpan Konfigurasi**.
   * Logo perusahaan baru akan langsung aktif dan ditampilkan secara otomatis pada header/topbar di seluruh halaman portal web.

### 12.2 Manajemen Hak Akses Pengguna (`/settings/users`)
* Menampilkan daftar seluruh akun sistem.
* Fitur administrator:
  * Menambah akun staf operasional baru.
  * Mereset kata sandi akun jika pengguna lupa kata sandi.
  * Menetapkan atau mengubah *Role* akun (Super Admin, HRD, Manager, atau Karyawan).
  * Menghapus atau menonaktifkan akun yang mencurigakan.

### 12.3 Jejak Audit Aktivitas (Audit Trail & Activity Logs — `/settings/audit-logs`)
* Sistem secara otomatis mencatat seluruh peristiwa manipulasi data penting:
  * **Pelaku (User Actor)**: Siapa pengguna yang melakukan tindakan.
  * **Jenis Aksi**: Create (tambah data), Update (ubah data), atau Delete (hapus data).
  * **Model / Modul Sasaran**: Perubahan pada Data Karyawan, Profil Perusahaan, Konfigurasi Payroll, dll.
  * **Perbandingan Nilai Data**: Menampilkan data lama (*old values*) berdampingan dengan data baru (*new values*).
  * **Waktu & IP Address**: Waktu kejadian tercatat akurat beserta alamat IP perangkat pelaku.

---

## 13. PANDUAN OPERASIONAL APLIKASI MOBILE (FLUTTER)

Aplikasi mobile VALRYZE diperuntukkan bagi kemudahan presensi karyawan di lapangan maupun di kantor.

### 13.1 Persyaratan Perangkat Keras & Lunak
* **Sistem Operasi**: Android OS versi 8.0 (Oreo) ke atas atau Apple iOS versi 13.0 ke atas.
* **Perangkat Keras Wajib**:
  - Sensor GPS Aktif (Mode Akurasi Tinggi).
  - Kamera Depan berfungsi normal dengan resolusi minimal 2 MP.
* **Koneksi Jaringan**: Terhubung ke internet (4G / 5G / Wi-Fi stabil).

### 13.2 Alur Presensi Mobile
1. Buka aplikasi **VALRYZE Mobile** dan login menggunakan email & kata sandi resmi Anda.
2. Di layar utama, aplikasi secara otomatis mendeteksi shift kerja Anda hari ini dan menghitung jarak Anda ke kantor terdekat.
3. Tekan tombol **KIRIM ABSEN MASUK**:
   - Posisikan wajah Anda pada lingkaran kamera selfie.
   - Tekan tombol capture foto.
   - Aplikasi memverifikasi akurasi GPS dan memastikan Anda berada dalam radius kantor.
   - Tekan konfirmasi kirim; notifikasi sukses akan muncul di layar.
4. Saat jam pulang tiba, tekan tombol **KIRIM ABSEN PULANG** dan ulangi pengambilan foto verifikasi kepulangan.

### 13.3 Penanganan Kendala Mock Location (Fake GPS)
* Aplikasi mobile dilengkapi library deteksi mock provider.
* Jika smartphone mendeteksi adanya aplikasi Fake GPS atau opsi *Mock Location App* aktif pada *Developer Options*, aplikasi akan menampilkan pesan peringatan merah:  
  `"⚠️ Terdeteksi penggunaan GPS palsu (Fake GPS). Absensi ditolak!"`
* **Solusi**: Nonaktifkan opsi pengembang (*developer options*) dan hapus aplikasi manipulasi lokasi dari smartphone Anda.

---

## 14. STANDAR KEAMANAN, MONITORING, & TROUBLESHOOTING

### 14.1 Proteksi Keamanan Backend & API
1. **Defensive HTTP Security Headers**:
   Sistem telah dilengkapi `SecurityHeadersMiddleware` aktif yang menyuntikkan header keamanan pada setiap respons HTTP:
   - `X-Frame-Options: SAMEORIGIN`: Menangkal serangan *Clickjacking* (mencegah website disematkan di dalam iframe situs jahat).
   - `X-Content-Type-Options: nosniff`: Mencegah manipulasi tipe berkas berbahaya via *MIME-type sniffing*.
   - `X-XSS-Protection: 1; mode=block`: Menangkal injeksi skrip berbahaya (*Cross-Site Scripting*).
   - `Referrer-Policy: strict-origin-when-cross-origin`: Melindungi data token autentikasi saat berpindah domain.
   - `Permissions-Policy: camera=*, geolocation=*`: Membatasi izin hardware peramban hanya untuk kebutuhan presensi resmi.
2. **Otorisasi Role Berlapis**:
   - Parameter `bypass_restrictions` terkunci di level server hanya untuk peran `super_admin`, `hrd`, dan `manager`.
   - Modul unggah dan hapus dokumen SOP perusahaan dilindungi middleware `role:super_admin|hrd`.

### 14.2 Panduan Menjalankan Web Server Mandiri
Jika server lokal sempat terhenti atau komputer dihidupkan ulang, jalankan perintah berikut pada terminal PowerShell:

```powershell
# 1. Pindah ke direktori utama aplikasi
cd D:\Portal

# 2. Menjalankan server web PHP 8.2 di port 8000
D:\laragon\bin\php\php-8.2.34-Win32-vs16-x64\php.exe -S 127.0.0.1:8000 -t public
```
Aplikasi akan langsung dapat diakses kembali di: `http://127.0.0.1:8000/`.

### 14.3 Tabel Solusi Permasalahan Teknis (Troubleshooting FAQ)

| No | Gejala Permasalahan | Kemungkinan Penyebab | Langkah Solusi Perbaikan |
| :-: | :--- | :--- | :--- |
| **1** | Gambar logo perusahaan atau foto presensi muncul tanda silang / ikon rusak (*broken image 404*). | Tautan symlink direktori `public/storage` terputus atau mengarah ke path yang salah. | Buka terminal dan jalankan: `D:\laragon\bin\php\php-8.2.34-Win32-vs16-x64\php.exe artisan storage:link`. Pastikan link mengarah ke `storage/app/public`. |
| **2** | Tampilan antarmuka website terlihat polos tanpa CSS atau ikon membesar anomali. | Terdapat berkas sisa `public/hot` saat server development Vite tidak aktif. | Hapus berkas `D:\Portal\public\hot`, lalu lakukan hard refresh di browser dengan menekan tombol `Ctrl + F5` atau `Ctrl + Shift + R`. |
| **3** | Muncul pesan error saat absen masuk: *"Lokasi Anda terlalu jauh dari kantor"*. | Koordinat GPS ponsel meleset atau berada di luar lingkaran radius toleransi geofence. | Buka Google Maps untuk memperbarui akurasi GPS smartphone Anda, atau hubungi HRD untuk memperluas radius geofence di menu Master Lokasi jika area gedung kantor sangat luas. |
| **4** | Muncul pesan error saat absen masuk: *"Anda berada di luar jam absensi untuk shift"*. | Karyawan mencoba melakukan absen masuk lebih awal dari 60 menit sebelum shift dimulai atau setelah shift berakhir. | Absensi hanya dibuka mulai 60 menit sebelum jam mulai shift hingga jam selesai shift. Pastikan memilih shift kerja yang sesuai dengan jadwal Anda. |
| **5** | Gagal masuk sistem dan muncul error: *"Too Many Requests"* (Error 429). | Terjadi kesalahan input password sebanyak lebih dari 10 kali dalam 1 menit. | Sistem mengaktifkan proteksi rate limiter. Harap tunggu selama 60 detik hingga blokir otomatis terbuka kembali. |
| **6** | Status karyawan cuti namun tombol absen masuk tetap terbuka. | Pengajuan cuti karyawan belum berstatus disetujui (*approved*) oleh Manager/HRD. | Pastikan Manager atau HRD telah menekan tombol *Setujui (Approve)* pada pengajuan cuti yang bersangkutan di sistem. |

---

*Buku panduan ini disusun sebagai pedoman resmi operasional portal VALRYZE HRIS. Dilarang menggandakan atau menyebarluaskan dokumen ini tanpa izin tertulis dari manajemen perusahaan.*
