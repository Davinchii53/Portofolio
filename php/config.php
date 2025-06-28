<?php
// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Ganti dengan username MySQL Anda
define('DB_PASS', '');          // Ganti dengan password MySQL Anda
define('DB_NAME', 'portfolio_db');

// Koneksi ke database
function getDBConnection() {
    try {
        $conn = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME,
            DB_USER, 
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        error_log("Koneksi database gagal: " . $e->getMessage());
        return null;
    }
}

// Fungsi keamanan dasar
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>