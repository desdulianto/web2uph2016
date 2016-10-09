<?php
require_once "config.php";

// fungsi untuk membuka koneksi ke database sesuai dengan
// konfigurasi di config.php
function konek_db() {
    global $DB;

    // buka koneksi ke database -- menggunakan mysqli
    // parameter 1, nama host database server
    // parameter 2, user koneksi
    // parameter 3, password koneksi
    $conn = mysqli_connect($DB['host'], $DB['user'], $DB['password']);
    if (! $conn)
        die("<p>Koneksi database gagal.</p>");

    // buka database yang akan dioperasikan
    // parameter 1, object koneksi
    // parameter 2, nama database yang akan dibuka
    $db = $conn->select_db($DB['db']);
    if (! $db)
        die("<p>Tidak dapat membuka database.</p>");

    return $conn;
}
?>
