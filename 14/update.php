<?php
require_once "db.php";
require_once "twig.php";

if (! isset($_GET["id"])) {
    echo $twig->render("error.html", array("pesan"=>"Error request"));
    return;
}

if (! isset($_POST["nama"]) ||
    ! isset($_POST["harga"])) {
    echo $twig->render("error.html", array("pesan"=>"Data produk tidak lengkap"));
    return;
}

$conn = konek_db();

$id    = $_GET["id"];
$nama  = $_POST["nama"];
$harga = $_POST["harga"];

// periksa apakah id produk yang akan di-edit memang tersedia di database
$rows = get_produk_by_id($conn, $id);

if (! $rows) {
    echo $twig->render("error.html", array("pesan"=>"Gagal query"));
    return;
}

if ($rows->num_rows == 0) {
    echo $twig->render("error.html", array("pesan"=>"Produk tidak ditemukan"));
    return;
}

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
        echo $twig->render("error.html", array("pesan"=>"Masalah dengan upload file"));
        return;
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
    header("location: index.php");
else
    echo $twig->render("error.html", array("pesan"=>"Gagal mengupdate produk"));
?>
