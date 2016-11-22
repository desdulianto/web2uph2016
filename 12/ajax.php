<?php
if (! isset($_GET["nama"]))
	$nama = "world";
else
	$nama = $_GET["nama"];
sleep(0.005);

echo "Hello, $nama from PHP";
?>