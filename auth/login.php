<?php
// File: auth/login.php
require_once '../config.php'; // Untuk BASE_URL dan session_start() yang mungkin sudah ada di config

// Jika sudah login, langsung redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'dashboard.php');
    exit;
}

// Logika untuk menampilkan pesan error atau pesan sukses logout
$display_message = ''; // Variabel untuk menampung pesan yang akan ditampilkan
$message_class = '';   // Variabel untuk class CSS pesan (error atau sukses)

if (isset($_GET['error'])) {
    $error_code = $_GET['error'];
    // Ambil pesan spesifik dari session jika ada, jika tidak, pakai pesan default
    $session_error_message = $_SESSION['pesan_error_login'] ?? ''; 
    $message_class = 'error-message'; // Default class untuk error

    if ($error_code == 1) { // Username atau password salah
        $display_message = !empty($session_error_message) ? $session_error_message : 'Username atau password salah!';
    } elseif ($error_code == 2) { // Harus login dulu
        $display_message = 'Anda harus login terlebih dahulu.';
    } elseif ($error_code == 3) { // Field kosong
        $display_message = !empty($session_error_message) ? $session_error_message : 'Username dan password wajib diisi.';
    } elseif ($error_code == 4) { // Akun tidak aktif <<<--- INI YANG PENTING KITA PASTIKAN ADA
        $display_message = !empty($session_error_message) ? $session_error_message : 'Akun Anda saat ini tidak aktif. Silakan hubungi Administrator.';
    } elseif ($error_code == 99) { // Error sistem
        $display_message = !empty($session_error_message) ? $session_error_message : 'Terjadi kesalahan pada sistem. Coba lagi nanti.';
    } else {
        $display_message = 'Terjadi kesalahan yang tidak diketahui.';
    }
    unset($_SESSION['pesan_error_login']); // Hapus pesan dari session setelah disiapkan

} elseif (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $display_message = "Anda telah berhasil logout.";
    $message_class = 'success-message'; // Class untuk pesan sukses
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Proyek Jaya</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login_style.css"> <style>
        /* Style untuk pesan error (kamu mungkin sudah punya ini) */
        .error-message { 
            background-color: #ffebee; /* Merah muda */
            color: #c62828; /* Merah tua */
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ef9a9a;
        }
        /* Style untuk pesan sukses (misalnya untuk logout) */
        .success-message { 
            background-color: #e8f5e9; /* Hijau muda */
            color: #2e7d32; /* Hijau tua */
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #a5d6a7;
        }
    </style>
</head>
<body>
    <div class="session"> <div class="left">
            <?php /* Gambar latar atau SVG jika ada di desainmu */ ?>
        </div>
        <form action="<?php echo BASE_URL; ?>auth/proses_login.php" method="POST">
            <h4>Login ke <span>Proyek Jaya</span></h4>
            <p>Selamat datang kembali! Silakan masukkan kredensial Anda.</p>

            <?php if (!empty($display_message)): ?>
                <div class="<?php echo $message_class; ?>"><?php echo $display_message; ?></div>
            <?php endif; ?>

            <div class="floating-label">
                <input placeholder="Username" type="text" name="username" id="username" autocomplete="off" required>
                <label for="username">Username:</label>
                </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off" required>
                <label for="password">Password:</label>
                </div>
            
            <button type="submit">Login</button>
            </form>
    </div>
</body>
</html>