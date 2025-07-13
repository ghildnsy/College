<?php

require_once('../../config.php');

class Pengguna
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // method find by email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE email_pengguna = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    // method create user register
    public function create($nama, $email, $instansi, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO pengguna (nama_pengguna, email_pengguna, instansi_pengguna, password_pengguna) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $instansi, $password);
        return $stmt->execute();
    }


    // method update user
    public function updateFieldById($id, $field, $value)
    {
        // Validasi field yang boleh diubah untuk menghindari SQL injection
        $allowedFields = ['nama_pengguna', 'email_pengguna', 'instansi_pengguna'];
        if (!in_array($field, $allowedFields)) {
            return false;
        }

        // Bangun query dinamis (hanya field yg diperbolehkan)
        $query = "UPDATE pengguna SET $field = ? WHERE id_pengguna = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $value, $id);
        return $stmt->execute();
    }


    // method get user by id
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pengguna WHERE id_pengguna = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
