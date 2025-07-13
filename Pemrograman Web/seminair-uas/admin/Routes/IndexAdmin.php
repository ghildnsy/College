<!-- Routing dashboard admin -->

<?php
$db = require_once '../../config.php';

require_once '../Controller/AdminController.php';
require_once '../Controller/EventController.php';

$page = $_GET['page'] ?? 'dashboard';

$AdminController = new AdminController($db);
$EventController = new EventController($db);

switch ($page) {
    case 'dashboard':
        $totalCategories = $EventController->getTotalCategories();
        $totalEvents = $EventController->getTotalEvents();
        $totalAdmins = $AdminController->getTotalAdmins();
        include '../Views/Dashboard.php';
        break;

    case 'dataevent':
        $events = $EventController->getAllEvents();
        $listKategori = $EventController->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                // Logika untuk DELETE
                $id_event_to_delete = $_POST['id_event_to_delete'] ?? null;
                if ($id_event_to_delete) {
                    $success = $EventController->deleteEvent($id_event_to_delete);
                    if ($success) {
                        header('Location: IndexAdmin.php?page=dataevent');
                        exit;
                    } else {
                        echo "Gagal menghapus event.";
                    }
                }
            } elseif (isset($_POST['id_event']) && !empty($_POST['id_event'])) {
                // Logika untuk UPDATE
                $data = [
                    'id_event' => $_POST['id_event'],
                    'id_kategori' => $_POST['id_kategori'],
                    'nama_event' => $_POST['nama_event'],
                    'gambar_event' => '', // Akan diisi di bawah
                    'tgl_event' => $_POST['tgl_event'],
                    'lokasi_event' => $_POST['lokasi_event'],
                    'penyelenggara_event' => $_POST['penyelenggara_event'],
                    'deskripsi_event' => $_POST['deskripsi_event'],
                    'tipe_event' => $_POST['tipe_event'],
                    'harga_event' => $_POST['harga_event'],
                ];

                // Handle upload gambar baru (jika ada)
                if (!empty($_FILES['gambar_event']['name'])) {
                    $imgDirectory = __DIR__ . '/../../assets/img/events/';
                    $fileName = basename($_FILES['gambar_event']['name']);
                    $targetFilePath = $imgDirectory . $fileName;

                    if (move_uploaded_file($_FILES['gambar_event']['tmp_name'], $targetFilePath)) {
                        $data['gambar_event'] = $fileName;
                    } else {
                        echo "Gagal upload gambar baru.";
                        exit;
                    }
                } else {
                    // Jika tidak upload baru, pakai gambar lama
                    $data['gambar_event'] = $_POST['gambar_event_lama'] ?? '';
                }

                $success = $EventController->updateEvent($data);

                if ($success) {
                    header('Location: indexadmin.php?page=dataevent');
                    exit;
                } else {
                    echo "Gagal update event.";
                }
            } else {
                // Logika untuk ADD (jika tidak ada 'id_event' di POST)
                $data = [
                    'id_kategori' => $_POST['id_kategori'],
                    'nama_event' => $_POST['nama_event'],
                    'gambar_event' => '', // Akan diisi di bawah
                    'tgl_event' => $_POST['tgl_event'],
                    'lokasi_event' => $_POST['lokasi_event'],
                    'penyelenggara_event' => $_POST['penyelenggara_event'],
                    'deskripsi_event' => $_POST['deskripsi_event'],
                    'tipe_event' => $_POST['tipe_event'],
                    'harga_event' => $_POST['harga_event'],
                ];

                // Handle upload gambar
                if (!empty($_FILES['gambar_event']['name'])) {
                    $imgDirectory = __DIR__ . '/../../assets/img/events/';
                    $fileName = basename($_FILES['gambar_event']['name']);
                    $targetFilePath = $imgDirectory . $fileName;

                    if (move_uploaded_file($_FILES['gambar_event']['tmp_name'], $targetFilePath)) {
                        $data['gambar_event'] = $fileName;
                    } else {
                        echo "Gagal upload gambar.";
                        exit;
                    }
                }

                $success = $EventController->addEvent($data);

                if ($success) {
                    header('Location: indexadmin.php?page=dataevent');
                    exit;
                } else {
                    echo "Gagal menambahkan event.";
                }
            }
        }
        include '../Views/DataEvent.php';
        break;

    case 'datakategori':

        $listKategori = $EventController->getAllCategories();
        include '../Views/DataKategori.php';
        break;

    case 'dataadmin':
        $listAdmins = $AdminController->getAllAdmins();
        include '../Views/DataAdmin.php';
        break;

    case 'datapeserta':
        // logic pengambilan data untuk datapeserta
        $selected_event_id = isset($_GET['filter_event']) && $_GET['filter_event'] !== ''
            ? (int) $_GET['filter_event']
            : null;

        $all_events = $EventController->getAllEvents(); // Ambil semua event untuk dropdown dari EventController
        $participants = $EventController->getParticipants($selected_event_id); // Ambil peserta yang difilter dari EventController

        include '../Views/DataPeserta.php';
        break;


    default:
        echo "Halaman tidak ditemukan.";
        break;
}
