<?php
require_once "db.php";
require_once "twig.php";

if (! isset($_GET["id"])) {
    echo $twig->render("rror.html", array("pesan"=>"ID produk tidak diketahui"));
    return;
}

$conn = konek_db();

$id    = $_GET["id"];

// periksa apakah id produk yang akan di-hapus memang tersedia di database
$rows = get_produk_by_id($conn, $id);

if (! $rows) {
    echo $twig->render("error.html", array("pesan"=>"Gagal query"));
    return;
}

if ($rows->num_rows == 0) {
    echo $twig->render("error.html", array("pesan"=>"Produk id $id tidak ditemukan"));
}

// ambil image produk, jika ada file image, hapus file image produk
$produk = $rows->fetch_object();
if ($produk->image)
    unlink($produk->image);

// delete data produk
$query = $conn->prepare("delete from produk where id=?");
$query->bind_param("i", $id);
$result = $query->execute();

if ($result)
    header("Location: index.php");
else
    echo $twig->render("error.html", array("pesan"=>"Gagal menghapus produk"));
?>
