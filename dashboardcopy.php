<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'auth/login.php?error=2'); 
    exit;
}

// Check user roles (only super_admin and admin have access)
$allowed_roles = ['super_admin', 'admin'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    $_SESSION['pesan_error'] = "MAAF, ANDA TIDAK MEMILIKI HAK AKSES KE HALAMAN MANAJEMEN KLIEN.";
    header('Location: ' . BASE_URL . 'absensi/index.php');
    exit;
}

$user_role = $_SESSION['role'];
$page_title = "Dashboard";

// Database Queries
$currentDate = date('Y-m-d');

// 1. Pekerja hadir hari ini and total pekerja
$query_hadir = "
    SELECT 
        COUNT(DISTINCT a.id_pekerja) AS hadir, 
        (SELECT COUNT(*) FROM pekerja WHERE is_active = 1) AS total_pekerja
    FROM absensi a
    WHERE a.tanggal = CURDATE() AND a.status_hadir = 1
";
$result_hadir = mysqli_query($conn, $query_hadir);
$data_hadir = mysqli_fetch_assoc($result_hadir);

// 2. Proyek aktif
$query_proyek_aktif = "SELECT COUNT(*) AS total FROM projek WHERE status = 'active'";
$result_proyek = mysqli_query($conn, $query_proyek_aktif);
$proyek_aktif = mysqli_fetch_assoc($result_proyek)['total'];

// 3. Proyek belum diabsen hari ini
$query_belum_absen = "
    SELECT COUNT(DISTINCT p.id_projek) AS total
    FROM projek p
    WHERE p.status = 'active'
    AND p.id_projek NOT IN (
        SELECT DISTINCT id_projek 
        FROM absensi 
        WHERE tanggal = CURDATE()
    )
";
$result_belum_absen = mysqli_query($conn, $query_belum_absen);
$belum_absen = mysqli_fetch_assoc($result_belum_absen)['total'];

// 4. Total klien
$query_klien = "SELECT COUNT(*) AS total FROM klien";
$result_klien = mysqli_query($conn, $query_klien);
$total_klien = mysqli_fetch_assoc($result_klien)['total'];

// 5. Proyek selesai bulan ini
$query_selesai = "
    SELECT COUNT(*) AS total 
    FROM projek 
    WHERE status = 'completed' 
    AND MONTH(tanggal_selesai_projek) = MONTH(CURDATE()) 
    AND YEAR(tanggal_selesai_projek) = YEAR(CURDATE())
";
$result_selesai = mysqli_query($conn, $query_selesai);
$proyek_selesai = mysqli_fetch_assoc($result_selesai)['total'];

// Alerts (Proyek mendekati deadline, pekerja belum punya penugasan, pekerja tidak hadir)
$alerts = [];

// Alert 1: Proyek mendekati deadline (7 hari)
$query_deadline = "
    SELECT namaprojek, DATEDIFF(tanggal_selesai_projek, CURDATE()) AS sisa_hari 
    FROM projek 
    WHERE status = 'active' 
    AND tanggal_selesai_projek IS NOT NULL
    AND DATEDIFF(tanggal_selesai_projek, CURDATE()) BETWEEN 0 AND 7
    ORDER BY sisa_hari ASC
";
$result_deadline = mysqli_query($conn, $query_deadline);
while ($row = mysqli_fetch_assoc($result_deadline)) {
    $alerts[] = [
        'type' => 'warning',
        'message' => "Proyek {$row['namaprojek']} deadline {$row['sisa_hari']} hari lagi"
    ];
}

// Alert 2: Pekerja belum punya penugasan
$query_no_assignment = "
    SELECT COUNT(*) AS total 
    FROM pekerja p
    WHERE p.is_active = 1
    AND p.id_pekerja NOT IN (
        SELECT id_pekerja FROM proyek_pekerja 
        WHERE is_active = 1
    )
";
$result_no_assignment = mysqli_query($conn, $query_no_assignment);
$no_assignment = mysqli_fetch_assoc($result_no_assignment)['total'];
if ($no_assignment > 0) {
    $alerts[] = [
        'type' => 'info',
        'message' => "{$no_assignment} pekerja belum punya penugasan aktif"
    ];
}

// Alert 3: Pekerja tidak masuk 3 hari berturut-turut
$query_absent = "
    SELECT p.namapekerja, 
           COUNT(DISTINCT DATE(a.tanggal)) AS hari_masuk
    FROM pekerja p
    JOIN proyek_pekerja pp ON p.id_pekerja = pp.id_pekerja
    LEFT JOIN absensi a ON p.id_pekerja = a.id_pekerja 
        AND a.tanggal >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND a.tanggal < CURDATE()
        AND a.status_hadir = 1
    WHERE pp.is_active = 1
    GROUP BY p.id_pekerja
    HAVING hari_masuk = 0
";
$result_absent = mysqli_query($conn, $query_absent);
while ($row = mysqli_fetch_assoc($result_absent)) {
    $alerts[] = [
        'type' => 'danger',
        'message' => "{$row['namapekerja']} sudah 3 hari berturut-turut tidak masuk"
    ];
}

// Query untuk Proyek Aktif
$query_proyek_list = "
    SELECT p.*, k.nama_klien, pk.namapekerja AS nama_mandor,
           (SELECT COUNT(DISTINCT id_pekerja) FROM proyek_pekerja WHERE id_projek = p.id_projek AND is_active = 1) AS jumlah_pekerja,
           (SELECT COUNT(DISTINCT a.id_pekerja) FROM absensi a WHERE a.id_projek = p.id_projek AND a.tanggal = CURDATE() AND a.status_hadir = 1) AS hadir_hari_ini
    FROM projek p
    LEFT JOIN klien k ON p.id_klien = k.id_klien
    LEFT JOIN pekerja pk ON p.id_mandor_pekerja = pk.id_pekerja
    WHERE p.status = 'active'
    ORDER BY p.tanggal_mulai_projek DESC
    LIMIT 5
";
$result_proyek_list = mysqli_query($conn, $query_proyek_list);

// Query untuk Top 5 Klien
$query_top_klien = "
    SELECT k.nama_klien, COUNT(p.id_projek) AS jumlah_proyek,
           SUM(CASE WHEN p.status = 'active' THEN 1 ELSE 0 END) AS proyek_aktif
    FROM klien k
    LEFT JOIN projek p ON k.id_klien = p.id_klien
    GROUP BY k.id_klien
    HAVING jumlah_proyek > 0
    ORDER BY proyek_aktif DESC, jumlah_proyek DESC
    LIMIT 5
";
$result_top_klien = mysqli_query($conn, $query_top_klien);

// Query untuk Pekerja dengan Kehadiran Rendah
$query_low_attendance = "
    SELECT p.namapekerja, 
           COUNT(DISTINCT CASE WHEN a.status_hadir = 1 THEN a.tanggal END) AS hari_hadir,
           COUNT(DISTINCT a.tanggal) AS hari_kerja,
           ROUND((COUNT(DISTINCT CASE WHEN a.status_hadir = 1 THEN a.tanggal END) / COUNT(DISTINCT a.tanggal)) * 100, 1) AS persentase
    FROM pekerja p
    JOIN absensi a ON p.id_pekerja = a.id_pekerja
    WHERE a.tanggal >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    GROUP BY p.id_pekerja
    HAVING persentase < 80 AND hari_kerja >= 5
    ORDER BY persentase ASC
    LIMIT 5
";
$result_low_attendance = mysqli_query($conn, $query_low_attendance);

// Query untuk Absensi 7 hari terakhir
$query_7days = "
    SELECT tanggal,
           COUNT(DISTINCT CASE WHEN status_hadir = 1 THEN id_pekerja END) AS hadir,
           COUNT(DISTINCT CASE WHEN status_hadir = 0 THEN id_pekerja END) AS tidak_hadir,
           COUNT(DISTINCT id_pekerja) AS total
    FROM absensi
    WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    AND tanggal <= CURDATE()
    GROUP BY tanggal
    ORDER BY tanggal DESC
";
$result_7days = mysqli_query($conn, $query_7days);

// Include header and sidebar based on user role
require_once '/includes/header.php'; 
if ($user_role == 'super_admin') {
    require_once '/includes/sidebar_super_admin.php';
} elseif ($user_role == 'admin') {
    require_once '/includes/sidebar_admin.php';
}
?>

<!-- Dashboard Layout -->
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, <?php echo $_SESSION['nama']; ?>!</p>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <!-- Card: Pekerja Hadir -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-2xl font-bold text-gray-800"><?php echo $data_hadir['hadir'] ?? 0; ?>/<?php echo $data_hadir['total_pekerja'] ?? 0; ?></h2>
            <p class="text-gray-600 text-sm">Pekerja Hadir</p>
            <p class="text-gray-500 text-xs">Hari Ini</p>
        </div>

        <!-- Card: Proyek Aktif -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-2xl font-bold text-gray-800"><?php echo $proyek_aktif; ?></h2>
            <p class="text-gray-600 text-sm">Proyek Aktif</p>
            <p class="text-gray-500 text-xs">Sedang Jalan</p>
        </div>

        <!-- Card: Proyek Belum Diabsen -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-2xl font-bold text-gray-800"><?php echo $belum_absen; ?></h2>
            <p class="text-gray-600 text-sm">Proyek Belum Diabsen</p>
            <p class="text-gray-500 text-xs">Hari Ini</p>
        </div>

        <!-- Card: Total Klien -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-2xl font-bold text-gray-800"><?php echo $total_klien; ?></h2>
            <p class="text-gray-600 text-sm">Total Klien</p>
            <p class="text-gray-500 text-xs">Perusahaan</p>
        </div>

        <!-- Card: Proyek Selesai Bulan Ini -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-2xl font-bold text-gray-800"><?php echo $proyek_selesai; ?></h2>
            <p class="text-gray-600 text-sm">Proyek Selesai Bulan Ini</p>
            <p class="text-gray-500 text-xs">Proyek</p>
        </div>
    </div>

    <!-- Alerts -->
    <?php if (!empty($alerts)): ?>
        <div class="mb-8 space-y-2">
            <?php foreach ($alerts as $alert): ?>
                <div class="alert alert-<?php echo $alert['type']; ?> p-4 rounded-lg flex items-center
                    <?php 
                    switch($alert['type']) {
                        case 'warning': echo 'bg-yellow-100 text-yellow-800'; break;
                        case 'danger': echo 'bg-red-100 text-red-800'; break;
                        case 'info': echo 'bg-blue-100 text-blue-800'; break;
                    }
                    ?>">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <?php echo htmlspecialchars($alert['message']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
