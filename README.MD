proyek_jaya/  (<- Ini folder utama/root proyek kita)
│
├── config.php                // File konfigurasi utama (DB, BASE_URL, dll. - AKAN KITA BUAT PERTAMA!)
│
├── dashboard.php             // Halaman dashboard utama setelah login
│
├── index.php                 // Halaman paling awal. Bisa jadi:
│                             //    1. Landing page (kalau ada, bisa pakai index.css & index.js mu)
│                             //    2. Atau, skrip sederhana yang redirect ke auth/login.php (jika belum login)
│                             //       atau ke dashboard.php (jika sudah login).
│
├── assets/                   // Folder untuk semua aset statis (CSS, JS, gambar)
│   ├── css/
│   │   ├── style.css         // CSS UTAMA untuk dashboard (yang kedua kamu kirim, dengan dark mode, sidebar, dll)
│   │   ├── login_style.css   // CSS KHUSUS untuk halaman login (yang pertama kamu kirim, dari SASS)
│   │   └── (mungkin) index_style.css // CSS untuk landing page jika index.php adalah landing page
│   │
│   ├── js/
│   │   ├── main.js           // JavaScript UTAMA untuk dashboard (interaksi UI, dark mode, dll)
│   │   └── (mungkin) index_script.js // JS untuk landing page jika index.php adalah landing page
│   │
│   └── images/               // Untuk menyimpan gambar-gambar (logo, ikon, dll.)
│
├── includes/                 // Folder untuk bagian-bagian template yang dipakai berulang
│   ├── header.php            // File header template (sudah kamu kirim!)
│   ├── footer.php            // File footer template (sudah kamu kirim!)
│   │
│   ├── sidebar_super_admin.php // Sidebar KHUSUS Super Admin (AKAN KITA BUAT/ADAPTASI)
│   ├── sidebar_admin.php       // Sidebar KHUSUS Admin (AKAN KITA BUAT/ADAPTASI)
│   ├── sidebar_mandor.php      // Sidebar KHUSUS Mandor (AKAN KITA BUAT/ADAPTASI)
│   │   // Catatan: File sidebar.php yang kamu kirim sebelumnya menggunakan satu file dengan if-else.
│   │   // Sesuai kesepakatan kita (pilihan no.1), kita akan buat file terpisah ini ya!
│   │   // Atau, kita bisa juga adaptasi file sidebar.php mu untuk 3 role Proyek Jaya. Gimana enaknya?
│   │   // Untuk sekarang, kita rencanakan yang terpisah dulu sesuai kesepakatan terakhir.
│   │
│   ├── auth_check.php        // Skrip untuk cek status login & hak akses (AKAN KITA BUAT)
│   │
│   └── [ROLE_SPECIFIC_CONTENT]/ // Folder untuk konten dashboard spesifik peran (opsional, mengikuti ide di dashboard.php mu)
│       ├── super_admin/
│       │   └── konten-super_admin.php
│       ├── admin/
│       │   └── konten-admin.php
│       └── mandor/
│           └── konten-mandor.php
│
├── auth/                     // Folder untuk semua yang berhubungan dengan autentikasi
│   ├── login.php             // Halaman form login (AKAN KITA BUAT)
│   ├── proses_login.php      // Skrip untuk memproses login (AKAN KITA BUAT)
│   ├── logout.php            // Skrip untuk logout (AKAN KITA BUAT)
│   └── (mungkin) register.php  // Jika ada fitur registrasi (style.scss mu ada .register-link)
│   └── (mungkin) proses_register.php
│
├── jabatan/                  // MODUL FITUR: Manajemen Jabatan
│   ├── index.php             // Tampilan daftar jabatan (Read)
│   ├── tambah_jabatan.php    // Form tambah jabatan (Create)
│   ├── edit_jabatan.php      // Form edit jabatan (Update)
│   └── proses_jabatan.php    // Skrip untuk proses CUD jabatan
│
├── pekerja/                  // MODUL FITUR: Manajemen Pekerja
│   ├── index.php
│   ├── tambah_pekerja.php
│   ├── edit_pekerja.php
│   └── proses_pekerja.php
│
├── klien/                    // MODUL FITUR: Manajemen Klien
│   ├── ... (struktur file CRUD serupa)
│
├── proyek/                   // MODUL FITUR: Manajemen Proyek
│   ├── ...
│
├── penugasan/                // MODUL FITUR: Penugasan Pekerja ke Proyek
│   ├── ...
│
├── absensi/                  // MODUL FITUR: Pencatatan Absensi
│   ├── ...
│
├── gaji/                     // MODUL FITUR: Penggajian
│   ├── ...
│
└── users/ atau pengguna/     // MODUL FITUR: Manajemen Pengguna Sistem (oleh Super Admin)
    ├── ...