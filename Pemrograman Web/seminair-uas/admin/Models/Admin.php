<?php
class Admin
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get admin by username

    public function getAdminByUsername($username)
    {
        $query = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get total admins

    public function getTotalAdmins()
    {
        $query = "SELECT COUNT(*) as total_admin FROM admin";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['total_admin'] ?? 0;
    }

    // Get all admins

    public function getAllAdmins()
    {
        $query = "SELECT * FROM admin";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
