<?php

class Event
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTotalEvents()
    {
        $query = "SELECT COUNT(*) as total_event FROM event";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['total_event'] ?? 0;
    }

    public function getTotalCategories()
    {
        $query = "SELECT COUNT(*) as total_category FROM kategori";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['total_category'] ?? 0;
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM kategori";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // method to get all events
    public function getAllEvents()
    {
        $query = "SELECT 
                event.*, 
                kategori.nama_kategori AS kategori_event
              FROM event
              JOIN kategori ON event.id_kategori = kategori.id_kategori";

        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // method to insert a new event
    public function insertEvent($data)
    {
        $sql = "INSERT INTO event (id_kategori, nama_event, gambar_event, tgl_event, lokasi_event, penyelenggara_event, deskripsi_event, tipe_event, harga_event)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        $stmt->bind_param(
            "isssssssi",
            $data['id_kategori'],
            $data['nama_event'],
            $data['gambar_event'],
            $data['tgl_event'],
            $data['lokasi_event'],
            $data['penyelenggara_event'],
            $data['deskripsi_event'],
            $data['tipe_event'],
            $data['harga_event']
        );

        return $stmt->execute();
    }

    public function updateEvent($data)
    {
        $sql = "UPDATE event SET
                 id_kategori = ?,
                 nama_event = ?,
                 gambar_event = ?,
                 tgl_event = ?,
                 lokasi_event = ?,
                 penyelenggara_event = ?,
                 deskripsi_event = ?,
                 tipe_event = ?,
                 harga_event = ?
            WHERE id_event = ?";

        $stmt = $this->db->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }


        $stmt->bind_param(
            "isssssssii",
            $data['id_kategori'],
            $data['nama_event'],
            $data['gambar_event'],
            $data['tgl_event'],
            $data['lokasi_event'],
            $data['penyelenggara_event'],
            $data['deskripsi_event'],
            $data['tipe_event'],
            $data['harga_event'],
            $data['id_event']
        );

        return $stmt->execute();
    }

    public function deleteEvent($id_event)
    {
        $query = "DELETE FROM event WHERE id_event = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id_event);
        return $stmt->execute();
    }

    public function getEventById($id_event)
    {
        $query = "SELECT gambar_event FROM event WHERE id_event = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id_event);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
