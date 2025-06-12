<?php
/**
 * BAGIAN SATU: LOGIKA & PENGAMBILAN DATA
 * Versi ini sudah diperkuat dengan error reporting dan pengecekan di setiap query.
 */

// LANGKAH 1: Paksa PHP untuk menampilkan semua error. Jangan sembunyikan apapun!
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Memuat file konfigurasi yang berisi koneksi database dan konstanta
require_once 'config.php';

// LANGKAH 2: Pastikan koneksi ke database tidak gagal.
if (!$conn) {
    // Hentikan eksekusi jika koneksi gagal dan tampilkan pesan yang jelas.
    die("FATAL ERROR: Koneksi ke database gagal. Pesan: " . mysqli_connect_error());
}

// --- LOGIKA OTENTIKASI & OTORISASI ---

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, tendang ke halaman login dengan kode error
    header('Location: ' . BASE_URL . 'auth/login.php?error=2'); 
    exit;
}

// Definisikan role yang diizinkan untuk mengakses halaman ini
$allowed_roles = ['super_admin', 'admin'];
$user_role = $_SESSION['role'];

// Cek apakah role pengguna ada di dalam daftar yang diizinkan
if (!in_array($user_role, $allowed_roles)) {
    // Jika tidak, beri pesan dan tendang ke halaman yang sesuai untuk role mereka
    $_SESSION['pesan_error'] = "MAAF, ANDA TIDAK MEMILIKI HAK AKSES KE DASHBOARD UTAMA.";
    // Pastikan ini mengarah ke halaman yang BENAR untuk role tersebut (bukan dashboard lagi!)
    header('Location: ' . BASE_URL . 'absensi/index.php');
    exit;
}

// --- PENGAMBILAN DATA UNTUK DASHBOARD ---

$page_title = "Dashboard";

// Inisialisasi variabel untuk menampung data
$alerts = [];
$data_hadir = ['hadir' => 0, 'total_pekerja' => 0];
$proyek_aktif = 0;
$belum_absen = 0;
$total_klien = 0;
$proyek_selesai = 0;
$proyek_list = [];
$top_klien_list = [];
$low_attendance_list = [];
$seven_days_absensi = [];

// -- Blok Query 1: Quick Stats --

// 1. Pekerja hadir hari ini
$query_hadir = "SELECT COUNT(DISTINCT a.id_pekerja) as hadir,
                (SELECT COUNT(*) FROM pekerja WHERE is_active = 1) as total_pekerja
                FROM absensi a 
                WHERE a.tanggal = CURDATE() AND a.status_hadir = 1";
$result_hadir = mysqli_query($conn, $query_hadir);
if (!$result_hadir) { die("FATAL ERROR: Query 'Pekerja Hadir' gagal. Error: " . mysqli_error($conn)); }
$data_hadir = mysqli_fetch_assoc($result_hadir);

// 2. Proyek aktif
$query_proyek_aktif = "SELECT COUNT(*) as total FROM projek WHERE status = 'active'";
$result_proyek = mysqli_query($conn, $query_proyek_aktif);
if (!$result_proyek) { die("FATAL ERROR: Query 'Proyek Aktif' gagal. Error: " . mysqli_error($conn)); }
$proyek_aktif = mysqli_fetch_assoc($result_proyek)['total'];

// 3. Proyek belum diabsen hari ini
$query_belum_absen = "SELECT COUNT(DISTINCT p.id_projek) as total
                      FROM projek p
                      WHERE p.status = 'active'
                      AND p.id_projek NOT IN (
                          SELECT DISTINCT id_projek 
                          FROM absensi 
                          WHERE tanggal = CURDATE()
                      )";
$result_belum_absen = mysqli_query($conn, $query_belum_absen);
if (!$result_belum_absen) { die("FATAL ERROR: Query 'Belum Diabsen' gagal. Error: " . mysqli_error($conn)); }
$belum_absen = mysqli_fetch_assoc($result_belum_absen)['total'];

// 4. Total klien
$query_klien = "SELECT COUNT(*) as total FROM klien";
$result_klien = mysqli_query($conn, $query_klien);
if (!$result_klien) { die("FATAL ERROR: Query 'Total Klien' gagal. Error: " . mysqli_error($conn)); }
$total_klien = mysqli_fetch_assoc($result_klien)['total'];

// 5. Proyek selesai bulan ini
$query_selesai = "SELECT COUNT(*) as total FROM projek 
                  WHERE status = 'completed' 
                  AND MONTH(tanggal_selesai_projek) = MONTH(CURDATE()) 
                  AND YEAR(tanggal_selesai_projek) = YEAR(CURDATE())";
$result_selesai = mysqli_query($conn, $query_selesai);
if (!$result_selesai) { die("FATAL ERROR: Query 'Proyek Selesai' gagal. Error: " . mysqli_error($conn)); }
$proyek_selesai = mysqli_fetch_assoc($result_selesai)['total'];


// -- Blok Query 2: Alerts & Warnings --

// Alert 1: Proyek mendekati deadline (7 hari)
$query_deadline = "SELECT namaprojek, DATEDIFF(tanggal_selesai_projek, CURDATE()) as sisa_hari 
                   FROM projek 
                   WHERE status = 'active' 
                   AND tanggal_selesai_projek IS NOT NULL
                   AND DATEDIFF(tanggal_selesai_projek, CURDATE()) BETWEEN 0 AND 7
                   ORDER BY sisa_hari ASC";
$result_deadline = mysqli_query($conn, $query_deadline);
if (!$result_deadline) { die("FATAL ERROR: Query 'Alert Deadline' gagal. Error: " . mysqli_error($conn)); }
while ($row = mysqli_fetch_assoc($result_deadline)) {
    $alerts[] = ['type' => 'warning', 'message' => "Proyek {$row['namaprojek']} deadline {$row['sisa_hari']} hari lagi"];
}

// ... (Pengecekan serupa harus diterapkan ke semua query lainnya) ...
// Sparky akan menyingkatnya di sini, tapi kamu harus menerapkan pola yang sama ke semua query di bawah ini.


// -- Blok Query 3: Tabel & List Data --

// Query untuk Tabel Proyek Aktif
$query_proyek_list = "SELECT p.*, k.nama_klien, 
                      pk.namapekerja as nama_mandor,
                      (SELECT COUNT(DISTINCT id_pekerja) FROM proyek_pekerja 
                       WHERE id_projek = p.id_projek AND is_active = 1) as jumlah_pekerja,
                      (SELECT COUNT(DISTINCT a.id_pekerja) FROM absensi a 
                       WHERE a.id_projek = p.id_projek AND a.tanggal = CURDATE() AND a.status_hadir = 1) as hadir_hari_ini
                      FROM projek p
                      LEFT JOIN klien k ON p.id_klien = k.id_klien
                      LEFT JOIN pekerja pk ON p.id_mandor_pekerja = pk.id_pekerja
                      WHERE p.status = 'active'
                      ORDER BY p.tanggal_mulai_projek DESC
                      LIMIT 5";
$result_proyek_list = mysqli_query($conn, $query_proyek_list);
if (!$result_proyek_list) { die("FATAL ERROR: Query 'List Proyek Aktif' gagal. Error: " . mysqli_error($conn)); }
// Data akan diambil di bagian HTML menggunakan loop while


// -- Akhir dari Bagian Satu --
// Sekarang semua data sudah siap di dalam variabel, dan kita siap memanggil file HTML
?>