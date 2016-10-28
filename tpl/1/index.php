<?php
require_once "../Twig/Autoloader.php";

// setup twig
Twig_Autoloader::register();
// load template dari directory templates
$loader = new Twig_Loader_Filesystem("templates/");
$twig   = new Twig_Environment($loader);

// render tanpa variable nama
if (! isset($_GET["nama"]))
    echo $twig->render("form.html");
else {
    // render dengan variable nama
    $nama= $_GET["nama"];
    echo $twig->render("form.html", array("nama"=>$nama));
}
?>
