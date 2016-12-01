<?php
require_once "db.php";
require_once "twig.php";

// buka koneksi ke database -- menggunakan mysqli
$conn = konek_db();

$limit = 2;

$q = "%" . (isset($_GET["q"]) ? $_GET["q"] : "") . "%";
$p = isset($_GET["p"]) ? intval($_GET["p"]) : 1;

$offset = ($p * $limit) - $limit;	// ($p-1) * $limit

$stmt = "select * from produk where nama like ? limit ? offset ?";

$query = $conn->prepare($stmt);
$query->bind_param("sii", $q, $limit, $offset);
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

$stmt = "select count(*) as halaman from produk where nama like ?";
$query = $conn->prepare($stmt);
$query->bind_param("s", $q);
$result = $query->execute();
$rows = $query->get_result();
$row = $rows->fetch_object();
$pages = ceil($row->halaman / $limit);

// bangun url baru untuk pages filter
$q_s = $_SERVER["QUERY_STRING"];
$q_s = str_replace("&p=$p", "", $q_s);
$q_s = str_replace("p=$p", "", $q_s);

if ($p < 1 || $p > $pages) {
	die($twig->render("error.html", array("pesan"=>"Page not found")));
}

if (! $error)
    echo $twig->render("view.html", array("items"=>$data, "pages"=>$pages,
        "p"=>$p, "base_query"=>$q_s, "q"=>$_GET["q"]));
else
    echo $twig->render("error.html", array("pesan"=>$pesan));
?>

