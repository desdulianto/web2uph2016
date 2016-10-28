<?php
require_once "../twig.php";

// definisi data
$columns = array("nama"=>"Nama", "alamat"=>"Alamat", "telp"=>"No. Telepon");
$data    = array(array("nama"=>"Budi", "alamat"=>"Jl. Thamrin", "telp"=>"12345"),
                 array("nama"=>"Adi" , "alamat"=>"Jl. Asia", "telp"=>"4562342"),
                 array("nama"=>"Susi", "alamat"=>"Jl. Pandu", "telp"=>"734245"));
// render html dengan mengirimkan data
echo $twig->render("loop.html", array("columns"=>$columns, "items"=>$data));
?>
