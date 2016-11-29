<?php
require_once "db.php";
require_once "twig.php";

if (! isset($_GET["id"])) {
    echo $twig->render("error.html", array("pesan"=>"Error request"));
    return;
}

$conn = konek_db();

$id = $_GET["id"];

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

// tarik data dari result set ke object
$row = $rows->fetch_array();
$nama = $row->nama;
$harga = $row->harga;
$image = "images/no_image_available.png";
if ($row->image)
    $image = $row->image;

echo $twig->render("edit.html", array("produk"=>$row));
?>
