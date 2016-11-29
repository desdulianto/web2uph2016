<?php
require_once "db.php";
require_once "twig.php";

// buka koneksi ke database -- menggunakan mysqli
$conn = konek_db();

// get page
$limit = 2;
$p = isset($_GET["p"]) ? $_GET["p"] : 1;

// cek apakah ada yang disaring
$q = isset($_GET["q"])? $_GET["q"] : null;

// query seluruh data produk dari database
$stmt = "select * from produk";
if ($q != null) {
    $stmt .= " where nama like ?";
}

// limit query
$stmt .= " limit ? offset ?";

// bind page query
$page = ($p-1) * 2;

$query = $conn->prepare($stmt);
if ($q != null) {
    $q = '%' . $q . '%';
    $query->bind_param("sii", $q, $limit, $page);
} else {
    $query->bind_param("ii", $limit, $page);
}

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

// query banyak page
$stmt = "select count(*) as halaman from produk";
if ($q != null)
    $stmt .= " where nama like ?";
$query = $conn->prepare($stmt);
if ($q != null)
    $query->bind_param("s", $q);
$result = $query->execute();
$rows = $query->get_result();
$row = $rows->fetch_object();
$page_count = ceil($row->halaman/$limit);
$query = $_SERVER["QUERY_STRING"];
$pages = array();
// bangun url page
if (strpos($query, "p=$p")) {
    for ($page = 0; $page < $page_count; $page++) {
        $url = str_replace("p=$p", "p=" . ($page+1), $query);
        array_push($pages, $url);
    }
} else {
    for ($page = 0; $page < $page_count; $page++) {
        $url = $query . "&p=" . ($page + 1);
        array_push($pages, $url);
    }
}

if (! $error)
    echo $twig->render("view.html", array("items"=>$data, "pages"=>$pages));
else
    echo $twig->render("error.html", array("pesan"=>$pesan));
?>

