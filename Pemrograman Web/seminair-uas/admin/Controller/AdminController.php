<?php
require_once __DIR__ . '/../Models/Admin.php';

class AdminController
{
    private $adminModel;

    public function __construct($db)
    {
        $this->adminModel = new Admin($db);
        session_start();
    }

    public function login($username, $password)
    {
        $admin = $this->adminModel->getAdminByUsername($username);
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin;
            header("Location: ../Routes/IndexAdmin.php?page=dashboard");
            exit;
        } else {
            $error = "Username atau password salah";
            include __DIR__ . '/../Views/Login.php';
        }
    }

    public function showLogin()
    {
        include __DIR__ . '/../Views/Login.php';
    }

    // get total admins
    public function getTotalAdmins()
    {
        return $this->adminModel->getTotalAdmins();
    }

    public function getAllAdmins()
    {
        return $this->adminModel->getAllAdmins();
    }
}
