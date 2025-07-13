<?php
if (isset($_GET['page'])) {
    $halaman = $_GET['page']; // Mengakses variable URL

    if ($halaman == "home") {
        include("depan.php");
    } elseif ($halaman == "profil") {
        include("profil.php");
    } elseif ($halaman == "galeri") {
        include("gallery.php");
    }

} else {
    echo "<p>Selamat datang di halaman utama.</P>";
}
