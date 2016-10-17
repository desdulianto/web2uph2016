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

$image = null;
$imgname = null;
if (isset($_FILES["image"])) {
    $image = $_FILES["image"];
}

// image lama produk
$produk = $rows->fetch_object();
$oldimage = null;
if ($produk->image)
    $oldimage = $produk->image;

// ada file gambar yang diupload, ganti file gambar produk
if ($image) {
    if ($image['error'] == 0 && file_exists($image['tmp_name'])) {

        // ambil nama file
        $filename = pathinfo($image['name'], PATHINFO_FILENAME);
        // ambil nama extension file
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        // lokasi directory tempat menyimpan file yang diupload
        $path = "images";

        // hapus image lama
        if ($oldimage)
            unlink($oldimage);

        // pindahkan file upload
        $imgname = get_upload_filename($path, $filename, $ext);
        move_uploaded_file($image['tmp_name'], $imgname);
    } else if ($image['error'] != 4) {
        die("<p>Ada masalah dengan upload file</p>");
    }
}

// jika tidak ada file image yang diupload, pakai kembali oldimage
if (! $imgname)
    $imgname = $oldimage;

// update data produk
$query = $conn->prepare("update produk set nama=?, harga=?, image=? where id=?");
$query->bind_param("siss", $nama, $harga, $imgname, $id);
$result = $query->execute();

if ($result)
    echo "<p>Produk berhasil diupdate</p>";
else
    echo "<p>Gagal update data produk</p>";
?>
    <p><a href="read.php">Kembali ke daftar produk</a></p>
</body>
</html>
