<?php
    if (isset ($_COOKIE['nama']) and isset ($_COOKIE ['nama2']))
    {
    echo "Nama Anda adalah : ". $_COOKIE['nama']."<br>";
    echo "Nama Teman Anda Adalah : ". $_COOKIE['nama2']."<br>";
}else{
      echo "Cookie Kosong";
     }
?>