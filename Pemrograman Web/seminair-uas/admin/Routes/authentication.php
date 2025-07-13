<?php

if (!isset($_SESSION['admin'])) {
    header("Location: ../Views/Login.php");
    exit;
}
