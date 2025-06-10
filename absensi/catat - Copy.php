<?php
// File: proyek_jaya/absensi/catat.php (Versi Baru - Fokus Hari Ini)

require_once '../config.php';

// 1. Autentikasi & Otorisasi: HANYA Mandor
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'mandor') {
    $_SESSION['pesan_error'] = "AKSES DITOLAK: Halaman ini hanya untuk Mandor.";
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit;
}
if (!isset($_SESSION['id_pekerja_ref']) || empty($_SESSION['id_pekerja_ref'])) {
    $_SESSION['pesan_error'] = "Data pekerja untuk akun Mandor Anda tidak ditemukan. Harap hubungi Super Admin.";
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit;
}

$id_mandor_login = $_SESSION['id_pekerja_ref'];
$user_role = $_SESSION['role'];
$tanggal_hari_ini = date('Y-m-d'); // Tanggal absensi dikunci ke hari ini

// 2. Ambil daftar proyek aktif yang dipegang oleh Mandor ini
$query_proyek_mandor = "SELECT id_projek, namaprojek FROM projek WHERE id_mandor_pekerja = ? AND status = 'active' ORDER BY namaprojek ASC";
$stmt_proyek_mandor = mysqli_prepare($koneksi, $query_proyek_mandor);
$daftar_proyek_mandor = [];
if ($stmt_proyek_mandor) {
    mysqli_stmt_bind_param($stmt_proyek_mandor, "i", $id_mandor_login);
    mysqli_stmt_execute($stmt_proyek_mandor);
    $result_proyek = mysqli_stmt_get_result($stmt_proyek_mandor);
    $daftar_proyek_mandor = mysqli_fetch_all($result_proyek, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt_proyek_mandor);
}

// 3. Tangani pemilihan proyek dari form (jika ada > 1 proyek)
$id_projek_terpilih = isset($_GET['id_projek']) ? intval($_GET['id_projek']) : null;

// Otomatis pilih proyek jika mandor hanya punya 1 proyek aktif
if (count($daftar_proyek_mandor) === 1 && is_null($id_projek_terpilih)) {
    $id_projek_terpilih = $daftar_proyek_mandor[0]['id_projek'];
}

// 4. Jika proyek sudah dipilih, ambil data tim dan absensi hari ini
$daftar_pekerja_absen = [];
$nama_proyek_terpilih = '';
if ($id_projek_terpilih) {
    $nama_proyek_terpilih_arr = array_values(array_filter($daftar_proyek_mandor, fn($p) => $p['id_projek'] == $id_projek_terpilih));
    if(!empty($nama_proyek_terpilih_arr)){
        $nama_proyek_terpilih = $nama_proyek_terpilih_arr[0]['namaprojek'];
    }

    // Query untuk mengambil tim proyek & data absensi mereka HARI INI
    $sql_tim = "SELECT p.id_pekerja, p.namapekerja, j.namajabatan, a.status_hadir, a.lembur, a.keterangan
                FROM proyek_pekerja pp
                JOIN pekerja p ON pp.id_pekerja = p.id_pekerja
                JOIN jabatan j ON p.id_jabatan = j.id_jabatan
                LEFT JOIN absensi a ON p.id_pekerja = a.id_pekerja AND a.id_projek = pp.id_projek AND a.tanggal = ?
                WHERE pp.id_projek = ? 
                  AND pp.is_active = 1
                  AND ? BETWEEN pp.tanggal_mulai_penugasan AND IFNULL(pp.tanggal_akhir_penugasan, '9999-12-31')
                ORDER BY p.namapekerja ASC";

    $stmt_tim = mysqli_prepare($koneksi, $sql_tim);
    if ($stmt_tim) {
        mysqli_stmt_bind_param($stmt_tim, "sis", $tanggal_hari_ini, $id_projek_terpilih, $tanggal_hari_ini);
        mysqli_stmt_execute($stmt_tim);
        $result_tim = mysqli_stmt_get_result($stmt_tim);
        $daftar_pekerja_absen = mysqli_fetch_all($result_tim, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt_tim);
    } else {
        $error_query = "Error mengambil data tim proyek: " . mysqli_error($koneksi);
    }
}

// Panggil Header & Sidebar
require_once '../includes/header.php'; 
require_once '../includes/sidebar_mandor.php';
?>

<main class="content-wrapper mt-16 md:ml-72">
    <div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8"> 
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-6">
                <i class="fas fa-calendar-check fa-fw mr-2 text-blue-500"></i>Catat Absensi Hari Ini (<?php echo date('d M Y'); ?>)
            </h1>

            <?php if (count($daftar_proyek_mandor) > 1): ?>
            
            <form method="GET" action="" class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border dark:border-gray-700">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Pilih proyek dan tanggal untuk memulai pencatatan absensi.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    
                    <div>
                        <label for="id_projek" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Proyek <span class="text-red-500">*</span></label>
                        <?php // Logika Cerdas untuk Menampilkan Pilihan Proyek ?>

                        <?php if (count($daftar_proyek_mandor) > 1): // Jika proyek > 1, tampilkan dropdown ?>
                            <select name="id_projek" id="id_projek" onchange="this.form.submit()" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">-- Pilih Proyek Anda --</option>
                                <?php foreach($daftar_proyek_mandor as $proyek_filter): ?>
                                    <option value="<?php echo $proyek_filter['id_projek']; ?>" <?php echo ($id_projek_terpilih == $proyek_filter['id_projek'] ? 'selected' : ''); ?>>
                                        <?php echo htmlspecialchars($proyek_filter['namaprojek']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif (count($daftar_proyek_mandor) === 1): // Jika hanya 1 proyek, tampilkan sebagai teks ?>
                            
                            <div class="mt-1 p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md w-full">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white"><?php echo htmlspecialchars($daftar_proyek_mandor[0]['namaprojek']); ?></p>
                            </div>
                            <input type="hidden" name="id_projek" value="<?php echo $daftar_proyek_mandor[0]['id_projek']; ?>">
                            <?php else: // Jika tidak ada proyek sama sekali ?>
                                <div class="mt-1 p-2.5 bg-yellow-100 dark:bg-yellow-900/50 rounded-md w-full">
                                <p class="text-sm text-yellow-800 dark:text-yellow-200">Anda tidak memimpin proyek aktif.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Tanggal Absensi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($tanggal_terpilih); ?>" class="mt-1 block w-full rounded-md ...">
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 ... bg-blue-600 ...">
                            <i class="fas fa-search fa-fw mr-2"></i>Tampilkan Lembar Absen
                        </button>
                    </div>
                </div>
            </form>
            <?php elseif (count($daftar_proyek_mandor) === 0): ?>
                 <p class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded-lg">Anda tidak memimpin proyek aktif saat ini. Tidak ada yang bisa diabsen.</p>
            <?php endif; ?>


            <?php if ($id_projek_terpilih): // Tampilkan lembar absensi hanya jika proyek sudah dipilih ?>
            <hr class="my-6 border-gray-300 dark:border-gray-700">
            <form action="<?php echo BASE_URL; ?>absensi/proses.php" method="POST">
                <input type="hidden" name="id_projek" value="<?php echo $id_projek_terpilih; ?>">
                <input type="hidden" name="tanggal" value="<?php echo $tanggal_hari_ini; ?>">

                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">
                    Lembar Absensi: <?php echo htmlspecialchars($nama_proyek_terpilih); ?>
                </h2>

                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full divide-y ...">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 ...">Nama Pekerja (Jabatan)</th>
                                <th class="px-6 py-3 text-center ...">Kehadiran</th>
                                <th class="px-6 py-3 text-center ...">Lembur</th>
                                <th class="px-6 py-3 text-left ...">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 ...">
                            <?php if (!empty($daftar_pekerja_absen)): ?>
                                <?php foreach ($daftar_pekerja_absen as $pekerja): ?>
                                    <tr>
                                        <td class="px-6 py-4 ...">
                                            <div class="font-semibold"><?php echo htmlspecialchars($pekerja['namapekerja']); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo htmlspecialchars($pekerja['namajabatan']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-4">
                                                <label><input type="radio" name="status_hadir[<?php echo $pekerja['id_pekerja']; ?>]" value="1" <?php echo (isset($pekerja['status_hadir']) && $pekerja['status_hadir'] == 1) ? 'checked' : (!isset($pekerja['status_hadir']) ? 'checked' : ''); ?> required> Hadir</label>
                                                <label><input type="radio" name="status_hadir[<?php echo $pekerja['id_pekerja']; ?>]" value="0" <?php echo (isset($pekerja['status_hadir']) && $pekerja['status_hadir'] == 0) ? 'checked' : ''; ?> required> Tidak Hadir</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <input type="hidden" name="lembur[<?php echo $pekerja['id_pekerja']; ?>]" value="0">
                                            <input type="checkbox" name="lembur[<?php echo $pekerja['id_pekerja']; ?>]" value="1" class="h-5 w-5 rounded ..." <?php echo (isset($pekerja['lembur']) && $pekerja['lembur'] == 1) ? 'checked' : ''; ?>>
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="text" name="keterangan[<?php echo $pekerja['id_pekerja']; ?>]" value="<?php echo htmlspecialchars($pekerja['keterangan'] ?? ''); ?>" class="w-full text-sm rounded-md ..." placeholder="Cth: Sakit, Izin">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center p-4">Tidak ada pekerja yang ditugaskan di proyek ini pada tanggal hari ini.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($daftar_pekerja_absen)): ?>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" name="simpan_absensi" value="1" class="inline-flex items-center px-6 py-3 ... bg-blue-600 ...">
                            <i class="fas fa-save fa-fw mr-2"></i>
                            Simpan Absensi Hari Ini
                        </button>
                    </div>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>
</div>