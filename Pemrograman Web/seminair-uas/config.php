<?php

$server = "localhost";
$user = "root";
$password = "";
$database_name = "seminair";

$db = new mysqli($server, $user, $password, $database_name);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}


return $db;
