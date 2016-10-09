<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh menambah data ke database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";

if (isset($_POST["nama"]) && isset($_POST["harga"])) {
    $nama  = $_POST["nama"];
    $harga = $_POST["harga"];

    // buka koneksi ke db -- db.php
    $conn = konek_db();

    // bangun query yang akan dieksekusi menggunakan prepared statement
    // simbol ? pada statement query akan diisikan dengan parameter query
    // sesuai dengan parameter pada pemanggilan method bind_param
    $query = $conn->prepare("insert into produk(nama, harga) values(?, ?)");
    // pasangkan parameter query dengan method bind_param
    // parameter pertama adalah string yang berisikan format data 
    // masing-masing parameter query
    // s -- string
    // i -- integer
    // d -- double
    // b -- blob/binary
    // parameter ke-dua dan seterusnya adalah parameter query
    // yang akan dipasangkan pada statement query
    $query->bind_param("si", $nama, $harga);

    // jalankan query
    $result = $query->execute();
    if (! $result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Data produk berhasil ditambahkan.</p>";
} else {
    echo "<p>Data produk belum diisi!</p>";
}
?>
<p><a href="read.php">Kembali ke daftar produk</a></p>
</body>
</html>
