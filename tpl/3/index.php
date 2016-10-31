<?php
require_once "db.php";
require_once "../twig.php";

// buka koneksi ke database -- menggunakan mysqli
$conn = konek_db();

// query seluruh data produk dari database
$query = $conn->prepare("select * from produk");
$result = $query->execute();

$error = false;
$pesan = null;
if (! $result) {
    $error = true;
    $pesan = "Gagal query";
}

// baca hasil query menjadi object result set
$rows = $query->get_result();

// loop setiap baris result set sebagai object
$data = array();
while ($row = $rows->fetch_object()) {
    $url_edit   = "edit.php?id=$row->id";
    $url_delete = "delete.php?id=$row->id";

    $image = "images/no_image_available.png";
    if ($row->image != null)
        $image = $row->image;

    $item = array("id"        =>$row->id,
                  "nama"      =>$row->nama,
                  "harga"     =>$row->harga,
                  "image"     =>$image,
                  "url_edit"  =>$url_edit,
                  "url_delete"=>$url_delete);

    array_push($data, $item);
}

if (! $error)
    echo $twig->render("3/view.html", array("items"=>$data));
else
    echo $twig->render("3/error.html", array("pesan"=>$pesan));
?>

