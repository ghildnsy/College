<?php

echo "Nama Anda Adalah : " . ($_COOKIE['nama'] ?? 'Tidak Ada') . "<br>";
echo "Nama Teman Anda Adalah :" . ($_COOKIE['nama2'] ?? 'Tidak Ada') . "<br>";
echo "<br>";

// Menghapus cookie 
setcookie("nama");

echo "Nama Anda Sekarang Ada/Tidak?: " . ($_COOKIE['nama'] ?? 'Tidak Ada') . "<br>";
echo "Nama Teman Anda Sekarang Ada/Tidak?: " . ($_COOKIE['nama2'] ?? 'Tidak Ada') . "<br>";
echo "<br>";
?>
