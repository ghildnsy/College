<?php
session_start();

require_once('../Model/Pengguna.php');
require_once('../../config.php');


class AuthController
{
    private $penggunaModel;

    public function __construct()
    {
        global $db; // dari config.php
        $this->penggunaModel = new Pengguna($db);
    }

    public function register()
    {
        $nama = filter_input(INPUT_POST, 'nama', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $instansi = filter_input(INPUT_POST, 'instansi', FILTER_UNSAFE_RAW);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $result = $this->penggunaModel->findByEmail($email);

        if ($result->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar!'); window.location.href='/src/views/register.php';</script>";
        } else {
            $sukses = $this->penggunaModel->create($nama, $email, $instansi, $passwordHash);
            if ($sukses) {
                echo "<script>alert('Registrasi berhasil!'); window.location.href='/src/views/login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal!'); window.location.href='/src/views/register.php';</script>";
            }
        }
    }


    public function showLogin()
    {
        include('../views/login.php');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->penggunaModel->findByEmail($email);
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Password harus dicek pakai password_verify jika hash
            if (password_verify($password, $user['password_pengguna'])) {
                // Simpan session user
                $_SESSION['user'] = [
                    'id' => $user['id_pengguna'],
                    'name' => $user['nama_pengguna'],
                    'email' => $user['email_pengguna'],
                    'instansi' => $user['instansi_pengguna'],
                ];

                // Redirect ke halaman utama
                header('Location: /');
                exit;
            } else {
                echo "<script>alert('Email atau Password salah!');</script>";
            }
        } else {
            echo "<script>alert('Email atau Password salah!');</script>";
        }
        include('../views/login.php');
    }


    // Method Logout
    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
