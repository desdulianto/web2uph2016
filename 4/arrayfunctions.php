<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Array Functions</title>
</head>
<body>
<?php
require_once "util.php";

$data = array("Budi", "Agus", "Iwan");

echo "<h1>array_push, array_pop, array_unshift, array_shift</h1>";
echo display_list($data);
echo "count: " . count($data) . "<br>";

echo "<h2>array_push: menambah item di belakang/akhir array. mengembalikan 
    banyak item di dalam array</h2>";
$n = array_push($data, "Susi");
echo "array_push: " . $n . "<br>";
echo display_list($data);

echo "<h2>array_pop: menghapus item dari belakang/akhir array. mengembalikan 
    item yang dihapus dari array</h2>";
$item = array_pop($data);
echo "array_pop: " . $item . "<br>";
echo display_list($data);

echo "<h2>array_unshift: menambahkan item di depan/awal array. mengembalikan 
    banyak item di dalam array</h2>";
$n = array_unshift($data, "Rudi");
echo "array_unshift: " . $n . "<br>";
echo display_list($data);

echo "<h2>array_shift: menghapus item dari depan/awal array. mengembalikan item 
    yang dihapus dari array</h2>";
$item = array_shift($data);
echo "array_shift: " . $item . "<br>";
echo display_list($data);

echo "<h1>array_search, in_array, sort, rsort</h1>";

echo "<h2>array_search: mencari item yang pertama ditemukan di dalam array. 
    mengembalikan posisi index data yang dicari di dalam array, false apabila 
    data yang dicari tidak ditemukan</h2>";
echo display_list($data);
echo "Data Budi diposisi: " . array_search("Budi", $data) . "<br>";
echo "Data Rudi diposisi: " . array_search("Rudi", $data) . "<br>";

echo "<h2>in_array: memeriksa apakah ada data tertentu di dalam array. 
    mengembalikan nilai true kalau data ditemukan, false jika tidak</h2>";
echo "Data Budi: " . in_array("Budi", $data) . "<br>";
echo "Data Rudi: " . in_array("Rudi", $data) . "<br>";

echo "<h2>sort: mengurutkan array secara ascending (dari kecil ke besar).</h2>";
$data2 = $data;
echo display_list($data2);
sort($data2);
echo display_list($data2);

echo "<h2>rsort: mengurutkan array secara descending(dari besar ke kecil).</h2>";
$data2 = $data;
echo display_list($data2);
rsort($data2);
echo display_list($data2);

echo "<h1>array_filter</h1>";
echo "<h2>array_filter: menyaring data array dengan memanggil callback function.
    callback function yang dipanggil menerima satu parameter yaitu masing-masing
    item data dari array. callback function mengembalikan nilai true untuk item 
    array yang tetap disertakan dan false apabila item array tersebut tidak mau 
    disertakan ke hasil filter</h2>";
$data2 = $data;

function filter_i($item) {
    if (stristr($item, "i"))
        return true;
    else
        return false;
    /* atau versi singkat
     *
     * if (stristr($item, "i"))
     *  return true;
     * return false;
     *
     * karena kalau ditemukan, fungsi langsung berhenti dengan nilai true
     * dan jika tidak ditemukan akan keluar dari block if dan return false
     */

    /* atau versi lebih singkatnya
     *
     * return stristr($item, "i"));
     *
     * karena fungsi stristr mengembalikan nilai posisi karakter di string jika 
     * ditemukan, dan false jika tidak ditemukan, maka fungsi filter ini cukup 
     * dengan mengembalikan hasil dari fungsi stristr
     */
}

echo display_list($data2);
$data2 = array_filter($data2, "filter_i");
echo display_list($data2);

/* catatan tambahan sejak PHP 5.3.0, PHP mendukung penggunaan anonymous function
 * atau closure. closure bisa digunakan dengan langsung mendefinisikan callback
 * function pada saat pemanggilan fungsi array_filter */

$data2 = $data;
$data2 = array_filter($data2, function($item) { 
                                return stristr($item, "a"); 
                              });
echo display_list($data2);
?>
</body>
</html>
