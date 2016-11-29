<?php
require_once "db.php";

$conn = konek_db();
header("Content-Type: application/json; charset=utf-8");
if (isset($_REQUEST["q"])) {
	$q = "%" . $_REQUEST["q"] . "%";
	$stmt = "select nama from produk where nama like ?";
	$query = $conn->prepare($stmt);
	$query->bind_param("s", $q);
	$query->execute();
	$result = $query->get_result();
	$rows = $result->fetch_all();
	
	$data = array();
	foreach ($rows as $row) {
		array_push($data, $row[0]);
	}
//$data = $rows;

	echo json_encode(array("suggestions"=>$data));
}
?>
