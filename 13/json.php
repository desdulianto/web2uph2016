<?php
require_once("db.php");

header("Content-Type: application/json; charset=utf-8");

$conn = konek_db();

if (is_string($conn)) {

    echo json_encode(array("status"=>array("code"=>"Error", "message"=>$conn)));
    return;
}

$query = $conn->prepare("select * from produk");
$result = $query->execute();

if (! $result) {
    echo json_encode(array("status"=>array("code"=>"Error", "message"=>"Error query DB")));
    return;
}

$rows = $query->get_result();
$num_rows = $rows->num_rows;
$data = $rows->fetch_all(MYSQLI_ASSOC);

// update lokasi image
function image_location($a) {
    if ($a["image"] == null)
        $a["image"] = "../tpl/3/images/no_image_available.png";
    else
        $a["image"] = "../tpl/3/" . $a['image'];
    return $a;
}

$data = array_map("image_location", $data);

echo json_encode(array(
                    "status"=>array("code"=>"Success",
                    "message"=>"Returned " . $num_rows . " rows of data"),
                    "data"=>$data
                ));
?>
