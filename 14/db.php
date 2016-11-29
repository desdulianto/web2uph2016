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

// fungsi untuk mencari produk berdasarkan id produk
// $conn -- object koneksi database
// $id   -- id produk yang dicari
// return false jika query gagal
// return object result set yang berisikan produk yang dicari
function get_produk_by_id($conn, $id) {
    $query = $conn->prepare("select * from produk where id=?");
    $query->bind_param("i", $id);
    $result = $query->execute();

    if (! $result)
        return false;

    return $query->get_result();
}

// fungsi untuk menghasilkan nama file yang diupload user ke server
// $path     - lokasi directory tempat upload file
// $filename - nama file yang diupload
// $ext      - extension file yang diupload
// kembalikan $filename.$ext apabila file belum ada di dalam $path
// kembalikan $filename-$n.$ext apabila sudah ada file di dalam $path
//      $n adalah nomor urut 1,2,3,...
function get_upload_filename($path, $filename, $ext) {
    $fullname = "$path/$filename.$ext";
    if (! file_exists($fullname))
        return $fullname;

    $n = 1;
    do {
        $fullname = "$path/$filename-$n.$ext";
        if (file_exists($fullname))
            $n++;
        else
            return $fullname;
    } while (true);
}

?>
