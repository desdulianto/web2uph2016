<?php
function display_list($array) {
    $hasil = "<ul>";
    foreach ($array as $item) {
        $hasil .= "<li>$item</li>";
    }
    $hasil .= "</ul>";
    return $hasil;
}
?>
