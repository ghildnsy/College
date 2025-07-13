<?php
if (!empty($_FILES)) {
    $file_name=$_FILES['filenya']['name'];
    $tmp_name=$_FILES['filenya']['tmp_name'];
        if (move_uploaded_file($tmp_name, "gambar/".$file_name)){
            echo ("Sukses di upload");
        }
        else {
            echo ("Gagal di upload");
        }
        }
        else {
            echo ("Anda belum pilih filenya");
        }
?>