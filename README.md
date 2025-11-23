<div align="center">
  <img src="assets/img/azrina_logo.png" alt="Logo Project" width="120">
  <h1 align="center">Sistem Informasi Manajemen Konstruksi</h1>
  
  <p align="center">
    <strong>ERP Sederhana untuk Kontraktor, Mandor, dan Manajemen Proyek</strong>
  </p>

  <p align="center">
    <img src="https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
    <img src="https://img.shields.io/badge/Alpine.js-2D3446?style=for-the-badge&logo=alpine.js&logoColor=white" alt="AlpineJS">
  </p>
</div>

---

## 📖 Tentang Project
Aplikasi ini dibangun untuk membantu perusahaan konstruksi (studi kasus: **PT. Azrina Solusi Indonesia**) dalam mengelola siklus proyek, mulai dari perencanaan hingga penggajian pekerja.

Sistem ini mengatasi masalah pencatatan manual dengan mendigitalkan proses absensi harian oleh Mandor di lapangan, yang kemudian terintegrasi langsung dengan sistem penggajian otomatis berdasarkan kehadiran dan lembur.

## 🔥 Fitur Unggulan

### 1. 🏗️ Manajemen Proyek & Tim
- **CRUD Proyek:** Status (Planning, Active, Completed).
- **Penugasan Pekerja:** Assign pekerja ke proyek tertentu dengan rentang tanggal.
- **Multi-Role:** Super Admin, Admin, dan Mandor.

### 2. 👷‍♂️ Absensi Digital (Role Mandor)
- Mandor hanya bisa melihat proyek yang ditugaskan kepadanya.
- Input absensi harian (Hadir/Tidak) dan Lembur via HP.
- Validasi otomatis (hanya bisa absen di hari H).

### 3. 💰 Payroll Automation
- **Hitung Gaji Otomatis:** Berdasarkan Gaji Pokok + (Total Hadir) + (Lembur) + Tunjangan.
- **Cetak Slip Gaji:** Generate slip gaji individu atau massal (PDF/Print friendly).
- **Laporan Keuangan:** Rekapitulasi pengeluaran gaji per periode.

### 4. 📊 Dashboard Eksekutif
- Statistik kehadiran pekerja hari ini.
- Monitoring proyek yang sedang berjalan (Active).
- Notifikasi proyek mendekati deadline.

---

## 📸 Screenshots (Preview)

| Dashboard Admin | Absensi Mandor |
|:---:|:---:|
| ![Dashboard](https://via.placeholder.com/400x200?text=Screenshot+Dashboard) | ![Absensi](https://via.placeholder.com/400x200?text=Screenshot+Absensi) |
| *Statistik & Monitoring* | *Input Absensi Mobile Friendly* |

| Slip Gaji | Manajemen Proyek |
|:---:|:---:|
| ![Slip Gaji](https://via.placeholder.com/400x200?text=Screenshot+Slip+Gaji) | ![Proyek](https://via.placeholder.com/400x200?text=Screenshot+List+Proyek) |

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Native PHP (Procedural Style & Prepared Statements untuk keamanan).
* **Database:** MySQL / MariaDB.
* **Frontend:** * **Tailwind CSS** (via CDN) untuk styling cepat & responsif.
    * **Alpine.js** untuk interaktivitas ringan (Dropdown, Sidebar).
    * **FontAwesome** untuk ikon.

---

## 📂 Struktur Folder

```text
📦 konstruksi-app
 ┣ 📂 absensi       # Modul pencatatan & rekap kehadiran
 ┣ 📂 assets        # CSS, JS, Images (Logo, Background)
 ┣ 📂 auth          # Login & Logout Logic
 ┣ 📂 gaji          # Modul perhitungan & cetak slip gaji
 ┣ 📂 includes      # Sidebar, Header, Footer, Auth Check
 ┣ 📂 jabatan       # Master data jabatan & gaji pokok
 ┣ 📂 klien         # Master data klien proyek
 ┣ 📂 pekerja       # Master data pekerja
 ┣ 📂 penugasan     # Logika assign pekerja ke proyek
 ┣ 📂 proyek        # CRUD Proyek
 ┣ 📂 users         # Manajemen user login (RBAC)
 ┣ 📜 config.php    # Koneksi Database & Base URL
 ┣ 📜 dashboard.php # Halaman utama setelah login
 ┗ 📜 index.php     # Landing Page (Company Profile)
