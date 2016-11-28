<?php
require_once("twig.php");
require_once("db.php");

header("Content-Type: text/xml");
$conn = konek_db();

if (is_string($conn)) {
    echo $twig->render("message.xml", array("status"=>"Error", "message"=>$conn));
    return;
}

$query = $conn->prepare("select * from produk");
$result = $query->execute();

if (! $result) {
    echo $twig->render("message.xml", array("status"=>"Error", "message"=>"Error query DB"));
    return;
}

$rows = $query->get_result();
$num_rows = $rows->num_rows;
$data = $rows->fetch_all(MYSQLI_ASSOC);

echo $twig->render("data.xml", array("status"=>"Success", 
    "message"=>"Returned " . $num_rows . " rows of data",
    "num_rows" => $num_rows,
    "data" => $data));
?>
