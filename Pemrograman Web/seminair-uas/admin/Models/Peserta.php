<?php

class Peserta
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Mengambil daftar peserta, bisa difilter berdasarkan ID Event.
     * Menggabungkan data dari tabel `daftar_peserta`, `pengguna`, dan `event`.
     *
     * @param int|null $id_event ID Event untuk filter, atau null untuk semua peserta.
     * @return array Array asosiatif dari data peserta.
     */
    public function getFilteredPeserta($id_event = null)
    {
        $sql = "SELECT
                    p.id_peserta,
                    u.nama_pengguna AS nama_peserta,
                    u.email_pengguna AS email_peserta,
                    u.instansi_pengguna AS instansi_peserta, 
                    e.nama_event,
                    p.status AS status_pembayaran_peserta
                FROM
                    daftar_peserta p  
                JOIN
                    pengguna u ON p.id_pengguna = u.id_pengguna
                JOIN
                    event e ON p.id_event = e.id_event";

        if ($id_event !== null) {
            $sql .= " WHERE p.id_event = ?";
            $stmt = $this->db->prepare($sql);
            if ($stmt === false) {
                die('Prepare failed: ' . $this->db->error);
            }
            $stmt->bind_param("i", $id_event);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            // Baris 45 akan berada di sini jika tanpa filter ($id_event === null)
            $result = $this->db->query($sql);
        }

        if ($result === false) {
            error_log("Query failed in getFilteredPeserta: " . $this->db->error);
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
