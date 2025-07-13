<?php
$db = require_once '../../config.php';
require_once '../Controller/AdminController.php';

$controller = new AdminController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login($_POST['username'], $_POST['password']);
} else {
    $controller->showLogin();
}
