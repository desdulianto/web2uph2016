<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";

if (! isset($_GET["id"]))
    die("<p>ID produk tidak diketahui</p>");

if (! isset($_POST["nama"]) ||
    ! isset($_POST["harga"]))
    die("<p>Data produk tidak lengkap</p>");

$conn = konek_db();

$id    = $_GET["id"];
$nama  = $_POST["nama"];
$harga = $_POST["harga"];

// periksa apakah id produk yang akan di-edit memang tersedia di database
$rows = get_produk_by_id($conn, $id);

if (! $rows)
    die("<p>Gagal query</p>");

if ($rows->num_rows == 0)
    die("<p>Produk id $id tidak ditemukan</p>");

// update data produk
$query = $conn->prepare("update produk set nama=?, harga=? where id=?");
$query->bind_param("sii", $nama, $harga, $id);
$result = $query->execute();

if ($result)
    echo "<p>Produk berhasil diupdate</p>";
else
    echo "<p>Gagal update data produk</p>";
?>
    <p><a href="read.php">Kembali ke daftar produk</a></p>
</body>
</html>
