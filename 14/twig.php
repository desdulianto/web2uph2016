<?php
require_once "Twig/Autoloader.php";

// definisi directory absolut dari file tpl.php
if (! defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__));

Twig_Autoloader::register();
// letakkan template pada directory templates
$loader = new Twig_Loader_Filesystem(ABSPATH . "/templates/");
$twig   = new Twig_Environment($loader);
?>
