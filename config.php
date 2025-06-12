<?php
/*
File: config.php (Versi Debug)
Fungsi: Untuk koneksi ke database dan settingan dasar.
Tujuan Debug: Untuk menampilkan error koneksi secara langsung dan detail.
*/

// --- TAHAP 1: AKTIFKAN LAPORAN ERROR MYSQLI ---
// Baris ini memaksa MySQLi untuk melaporkan semua error, jangan dilewatkan.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// --- TAHAP 2: PENGATURAN KONEKSI DATABASE ---
// Pastikan semua detail di bawah ini 100% benar sesuai dengan hosting kamu.
define('DB_HOST', 'localhost');         // Biasanya 'localhost' jika database di server yang sama.
define('DB_NAME', 'u951570841_kontraktor');              // Nama database kita yang sudah kita sepakati!
define('DB_USER', 'u951570841_ridwan');              // Ganti dengan username database MySQL kamu.
define('DB_PASS', 'Azrinaj4y4#');                  // Ganti dengan password database MySQL kamu (kosongkan jika tidak ada).

// --- TAHAP 3: PENGATURAN DASAR APLIKASI ---
// Pastikan BASE_URL sudah benar, diakhiri dengan garis miring '/'.
// CONTOH: 'https://moku-meubel.com/kontraktor/'
define('BASE_URL', 'https://kontraktor.moku-meubel.com/'); 


// --- TAHAP 4: PERCOBAAN KONEKSI ---
// Kita akan mencoba membuat koneksi di dalam blok try-catch.
// Blok ini akan "menangkap" error apapun yang terjadi saat koneksi.

$conn = null; // Inisialisasi variabel $conn sebagai null.

try {
    // PHP akan mencoba menjalankan kode di dalam blok 'try'.
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Set charset agar tidak ada masalah dengan karakter aneh
    mysqli_set_charset($conn, "utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Jika ada error APAPUN saat koneksi di blok 'try', PHP akan menjalankan blok 'catch' ini.
    // Kita akan menghentikan semua proses dan menampilkan pesan error yang sangat detail.
    
    // Tulis pesan error ke layar.
    echo "<!DOCTYPE html><html><head><title>Database Connection Error</title>";
    echo "<style>body { font-family: 'Courier New', monospace; padding: 20px; background-color: #1a1a1a; color: #ff4d4d; } .container { background-color: #333; border: 2px solid #ff4d4d; padding: 20px; border-radius: 5px; } h1 { border-bottom: 1px solid #ff4d4d; padding-bottom: 10px; } .code { color: #f1fa8c; } .info { color: #8be9fd; } .tip { color: #50fa7b; margin-top: 20px;}</style>";
    echo "</head><body>";
    echo "<div class='container'>";
    echo "<h1>[FATAL] Gagal Total Konek ke Database</h1>";
    echo "<p>Pesan Error dari Sistem: <strong class='code'>" . $e->getMessage() . "</strong></p>";
    echo "<p class='info'>Info Error Code: " . $e->getCode() . "</p>";
    echo "<hr>";
    echo "<h2>Langkah Pengecekan:</h2>";
    echo "<ol>";
    echo "<li>Cek file `config.php`: Apakah <strong>DB_SERVER</strong> ('" . DB_SERVER . "'), <strong>DB_USERNAME</strong> ('" . DB_USERNAME . "'), <strong>DB_PASSWORD</strong> (disembunyikan), dan <strong>DB_NAME</strong> ('" . DB_NAME . "') sudah 100% benar?</li>";
    echo "<li>Cek di cPanel/Panel Hosting: Apakah user database ('" . DB_USERNAME . "') sudah ditambahkan ke database ('" . DB_NAME . "') dan diberi semua hak akses (All Privileges)?</li>";
    echo "<li>Cek Hostname: Apakah benar 'localhost'? Beberapa hosting menggunakan alamat IP atau nama domain lain.</li>";
    echo "</ol>";
    echo "<p class='tip'>Tips: Copy pesan error di atas dan kirimkan balik untuk dianalisis lebih lanjut.</p>";
    echo "</div>";
    echo "</body></html>";
    
    // Hentikan eksekusi skrip sepenuhnya.
    exit();
}

// Jika berhasil melewati try-catch, artinya koneksi aman.
// Lanjutkan skrip seperti biasa.

?>
