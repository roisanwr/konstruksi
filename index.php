<?php
// Contoh password mentah: 'admin123'
// Ganti 'admin123' dengan password yang kamu mau untuk user contohmu
$passwordMentah = 'mandor123'; 
$hashPassword = password_hash($passwordMentah, PASSWORD_DEFAULT);
echo "Password mentah: " . $passwordMentah . "<br>";
echo "Hash passwordnya: " . $hashPassword;
// Copy hash password yang muncul ini ke kolom password di tabel users untuk user contohmu.
?>