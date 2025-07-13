<?php
session_start();
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_event = mysqli_real_escape_string($db, $_POST['id_event']);

    if (!isset($_SESSION['user'])) {
        header("Location: ../views/login.php?status=not_logged_in");
        exit;
    }

    $id_pengguna = $_SESSION['user']['id'];

    // Cek apakah sudah terdaftar
    $checkQuery = mysqli_query($db, "SELECT * FROM daftar_peserta WHERE id_event = '$id_event' AND id_pengguna = '$id_pengguna'");
    if (mysqli_num_rows($checkQuery) > 0) {
        header("Location: ../views/detailEvent.php?id=$id_event&status=already_registered");
        exit;
    }

    // Ambil info tipe event
    $eventQuery = mysqli_query($db, "SELECT tipe_event FROM event WHERE id_event = '$id_event'");
    if (!$eventQuery || mysqli_num_rows($eventQuery) == 0) {
        header("Location: ../views/detailEvent.php?id=$id_event&status=event_not_found");
        exit;
    }

    // Set status pembayaran
    $eventData = mysqli_fetch_assoc($eventQuery);

    // jika event gratis maka status peserta terbayar, jika tidak maka belum terbayar
    $status = ($eventData['tipe_event'] === 'gratis') ? 'terbayar' : 'belum_terbayar';

    // logic payment

    // Simpan pendaftaran
    $sql = "INSERT INTO daftar_peserta (id_event, id_pengguna, status)
            VALUES ('$id_event', '$id_pengguna', '$status')";

    if (mysqli_query($db, $sql)) {
        header("Location: ../views/detailEvent.php?id=$id_event&status=success");
    } else {
        echo "Gagal mendaftar: " . mysqli_error($db);
    }
} else {
    header("Location: ../views/detailEvent.php?id=$id_event&status=error");
}
