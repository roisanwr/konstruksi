<?php
// File: proyek_jaya/klien/index.php

// 1. Panggil Konfigurasi dan mulai session
require_once '../config.php'; 

// 2. Autentikasi: Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'auth/login.php?error=2'); 
    exit;
}

// 3. Autorisasi: Hanya Super Admin dan Admin yang boleh akses halaman ini.
$allowed_roles = ['super_admin', 'admin'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    $_SESSION['pesan_error'] = "MAAF, ANDA TIDAK MEMILIKI HAK AKSES KE HALAMAN MANAJEMEN KLIEN.";
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit;
}

// Ambil role pengguna dari session untuk menentukan sidebar mana yang di-load
$user_role = $_SESSION['role'];

// 4. Ambil semua data klien dari database, urutkan berdasarkan nama klien
$query_klien = "SELECT id_klien, nama_klien, alamat_klien, no_telp_klien, email_klien FROM klien ORDER BY nama_klien ASC";
$result_klien = mysqli_query($koneksi, $query_klien);

if (!$result_klien) {
    $error_query = "Error mengambil data klien: " . mysqli_error($koneksi);
}

// 5. Siapkan pesan notifikasi (jika ada dari proses tambah/edit/hapus sebelumnya)
$pesan_notifikasi = '';
if (isset($_SESSION['pesan_sukses'])) {
    $pesan_notifikasi = "<div class='mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow'>" . htmlspecialchars($_SESSION['pesan_sukses']) . "</div>";
    unset($_SESSION['pesan_sukses']); 
} elseif (isset($_SESSION['pesan_error_crud'])) {
    $pesan_notifikasi = "<div class='mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow'>" . htmlspecialchars($_SESSION['pesan_error_crud']) . "</div>";
    unset($_SESSION['pesan_error_crud']);
}

// 6. Memanggil komponen template: HEADER
require_once '../includes/header.php'; 

// 7. Memanggil komponen template: SIDEBAR (sesuai peran pengguna)
// PASTIKAN DI FILE SIDEBAR (sidebar_super_admin.php & sidebar_admin.php) SUDAH ADA LOGIKA UNTUK $menu_aktif = 'klien';
// Contoh: elseif (strpos($relative_path, 'klien/') === 0) { $menu_aktif = 'klien'; }
if ($user_role == 'super_admin') {
    require_once '../includes/sidebar_super_admin.php';
} elseif ($user_role == 'admin') {
    require_once '../includes/sidebar_admin.php';
}
?>

<main class="content-wrapper mt-16 md:ml-72"> <div class="max-w-full mx-auto p-4 sm:p-6 lg:p-8"> 

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">
                    Manajemen Klien
                </h1>
                <a href="<?php echo BASE_URL; ?>klien/tambah.php" 
                   class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150 ease-in-out">
                    <i class="fas fa-user-tie fa-fw mr-2"></i> Tambah Klien Baru
                </a>
            </div>

            <?php echo $pesan_notifikasi; ?>

            <?php if (isset($error_query)): ?>
                <div class='mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow'><?php echo htmlspecialchars($error_query); ?></div>
            <?php endif; ?>

            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Klien</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Alamat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Telepon</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php if ($result_klien && mysqli_num_rows($result_klien) > 0) : ?>
                            <?php $nomor = 1; ?>
                            <?php while ($klien = mysqli_fetch_assoc($result_klien)) : ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200"><?php echo $nomor++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($klien['nama_klien']); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200 break-words"><?php echo nl2br(htmlspecialchars($klien['alamat_klien'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200"><?php echo htmlspecialchars($klien['no_telp_klien']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200"><?php echo htmlspecialchars($klien['email_klien']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <a href="<?php echo BASE_URL; ?>klien/edit.php?id=<?php echo $klien['id_klien']; ?>" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 mr-3 transition-colors duration-150" title="Edit">
                                            <i class="fas fa-edit fa-fw"></i> <span class="sr-only">Edit</span>
                                        </a>
                                        <?php if ($_SESSION['role'] === 'super_admin') : // Tombol hapus mungkin hanya untuk Super Admin ?>
                                            <a href="<?php echo BASE_URL; ?>klien/proses.php?aksi=hapus&id=<?php echo $klien['id_klien']; ?>" 
                                               class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200 transition-colors duration-150" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus klien <?php echo htmlspecialchars(addslashes($klien['nama_klien'])); ?>? Tindakan ini tidak dapat dibatalkan!');" title="Hapus">
                                               <i class="fas fa-trash-alt fa-fw"></i> <span class="sr-only">Hapus</span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada data klien yang ditambahkan. Silakan klik "Tambah Klien Baru".
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div> </div> </div> </main>

<?php
// 9. Memanggil komponen template: FOOTER
require_once '../includes/footer.php'; 
?>