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

$conn = konek_db();

$id    = $_GET["id"];

// periksa apakah id produk yang akan di-hapus memang tersedia di database
$rows = get_produk_by_id($conn, $id);

if (! $rows)
    die("<p>Gagal query</p>");

if ($rows->num_rows == 0)
    die("<p>Produk id $id tidak ditemukan</p>");

// ambil image produk, jika ada file image, hapus file image produk
$produk = $rows->fetch_object();
if ($produk->image)
    unlink($produk->image);

// delete data produk
$query = $conn->prepare("delete from produk where id=?");
$query->bind_param("i", $id);
$result = $query->execute();

if ($result)
    echo "<p>Produk berhasil dihapus</p>";
else
    echo "<p>Gagal hapus data produk</p>";
?>
    <p><a href="read.php">Kembali ke daftar produk</a></p>
</body>
</html>
