<?php
session_start();
session_destroy();
header("Location: ../Views/Login.php");
exit;
