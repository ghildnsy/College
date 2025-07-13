<?php
include('../../config.php');
session_start();

// Ambil data user dari session
$nama_user = $_SESSION['user']['name'] ?? '';
$email_user = $_SESSION['user']['email'] ?? '';
$instansi_user = $_SESSION['user']['instansi'] ?? '';

$id_event = $_GET['id'] ?? null;

$event = null;
$queryPeserta = null;

if ($id_event) {
    $id_event = mysqli_real_escape_string($db, $id_event);

    // Query peserta yang mengikuti event ini
    $sqlPeserta = "SELECT 
            pengguna.nama_pengguna AS nama, 
            pengguna.email_pengguna AS email, 
            pengguna.instansi_pengguna AS instansi,
            daftar_peserta.status AS status
        FROM daftar_peserta 
        JOIN pengguna ON daftar_peserta.id_pengguna = pengguna.id_pengguna 
        WHERE daftar_peserta.id_event = '$id_event'";

    $queryPeserta = mysqli_query($db, $sqlPeserta);

    // Query detail event
    $sqlEvent = "SELECT * FROM event WHERE id_event = '$id_event'";
    $queryEvent = mysqli_query($db, $sqlEvent);

    if ($queryEvent && mysqli_num_rows($queryEvent) > 0) {
        $event = mysqli_fetch_assoc($queryEvent);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - Seminair</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <meta name="theme-color" content="#0f172a" />


    <!-- Favicon -->
    <link rel="icon" href="../../assets/icon/seminair.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">


</head>

<body>


    <div class="gradient-bg pt-5">
        <div id="scrollProgress"></div>

        <!-- toast notification -->
        <?php if (isset($_GET['status'])): ?>
            <?php
            $status = $_GET['status'];
            $toastTypes = [
                'already_registered' => ['text' => 'Anda sudah mendaftar pada event ini!', 'color' => 'danger'],
                'success' => ['text' => 'Pendaftaran berhasil!', 'color' => 'success'],
                'event_not_found' => ['text' => 'Event tidak ditemukan.', 'color' => 'warning'],
            ];
            if (isset($toastTypes[$status])):
                $toast = $toastTypes[$status];
            ?>
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
                    <div class="toast align-items-center text-white bg-<?= $toast['color'] ?> border-0" role="alert" data-bs-delay="4000">
                        <div class="d-flex">
                            <div class="toast-body">
                                <?= $toast['text'] ?>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>



        <!-- breadcrumb -->
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../views/events.php">Daftar Acara</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($event['nama_event'] ?? 'Detail') ?></li>
                </ol>
            </nav>

            <?php if ($event): ?>
                <div class="row mb-5">
                    <div class="col-md-5 mb-3">
                        <img src="../../assets/img/events/<?= htmlspecialchars($event['gambar_event']) ?>"
                            class="img-fluid w-100 rounded event-image"
                            alt="<?= htmlspecialchars($event['nama_event']) ?>">
                    </div>
                    <div class="col-md-7">
                        <h1 class="mb-3"><?= htmlspecialchars($event['nama_event']) ?></h1>
                        <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['lokasi_event']) ?></p>
                        <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($event['tgl_event'])) ?></p>
                        <p><strong>Penyelenggara:</strong> <?= htmlspecialchars($event['penyelenggara_event']) ?></p>

                        <?php if ($event['tipe_event'] === 'Berbayar'): ?>
                            <p><strong>Harga:</strong> Rp<?= number_format($event['harga_event'], 0, ',', '.') ?></p>
                        <?php endif; ?>

                        <p><strong>Deskripsi:</strong><br><?= nl2br(htmlspecialchars($event['deskripsi_event'])) ?></p>

                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- if user already login -->
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">
                                Ikuti Event
                            </button>
                        <?php else: ?>
                            <!-- if user is not logged in -->
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLoginDulu">
                                Ikuti Event
                            </button>
                        <?php endif; ?>


                        <!-- Modal Konfirmasi -->
                        <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="../Controller/PendaftaranController.php">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Pendaftaran</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin mendaftar ke event ini dengan data berikut?</p>
                                            <ul>
                                                <li><strong>Nama:</strong> <?= htmlspecialchars($nama_user) ?></li>
                                                <li><strong>Email:</strong> <?= htmlspecialchars($email_user) ?></li>
                                                <li><strong>Instansi:</strong> <?= htmlspecialchars($instansi_user) ?></li>
                                            </ul>
                                            <input type="hidden" name="id_event" value="<?= $event['id_event'] ?>">
                                            <input type="hidden" name="nama_peserta" value="<?= htmlspecialchars($nama_user) ?>">
                                            <input type="hidden" name="email_peserta" value="<?= htmlspecialchars($email_user) ?>">
                                            <input type="hidden" name="instansi_peserta" value="<?= htmlspecialchars($instansi_user) ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Ikut Event</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Login-->
                        <div class="modal fade" id="modalLoginDulu" tabindex="-1" aria-labelledby="modalLoginDuluLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLoginDuluLabel">Peringatan</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Anda belum login. Silakan login terlebih dahulu untuk mendaftar event ini.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../views/login.php" class="btn btn-primary">Login Sekarang</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <a href="../views/events.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>

            <?php endif; ?>
        </div>

        <!--  Tabel Daftar peserta -->
        <div class="container rounded mb-5 py-5 px-3 mt-5" style="background-color:rgb(17, 27, 49) ;">
            <h3 class="mb-4">Daftar Peserta</h3>
            <div class="table-responsive">
                <table id="daftarPeserta" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Instansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($Data = mysqli_fetch_assoc($queryPeserta)) : ?>
                            <tr>
                                <td class="text-truncate"><?= htmlspecialchars($Data['nama']) ?></td>
                                <td class="text-truncate"><?= htmlspecialchars($Data['email']) ?></td>
                                <td class="text-truncate"><?= htmlspecialchars($Data['instansi']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('../Components/footer.php'); ?>

    <!-- Script -->

    <script src="/js/script.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        // datatable pagination
        $(document).ready(function() {
            new DataTable('#daftarPeserta', {
                pageLength: 5,
                lengthMenu: [10],
                paging: true,
                info: true,
                searching: true
            });
        });
        // scroll progress
        window.onscroll = function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById("scrollProgress").style.width = scrolled + "%";
        };
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.querySelector('.toast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>


</body>

<style>
    body {
        background-color: #111827;
        /* fallback bg, biar gak polos */
        color: #e0e0e0;
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
    }

    .gradient-bg {
        background: linear-gradient(135deg, rgb(17, 27, 49), rgb(18, 24, 41), rgb(5, 38, 137));
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
        padding-bottom: 3rem;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }


    a {
        text-decoration: none;
    }

    h1,
    h2,
    p {
        color: #ffffff;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 2rem;
    }

    .breadcrumb-item a {
        color: #0d6efd;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #ffffff;
    }


    .breadcrumb-item+.breadcrumb-item::before {
        color: white !important;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    #example {
        background-color: #1e1e1e;
        color: #e0e0e0;
    }

    #example thead {
        background-color: #292929;
        color: #ffffff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #ffffff !important;
    }

    #scrollProgress {
        position: fixed;
        top: 0;
        left: 0;
        height: 5px;
        background-color: #0d6efd;
        width: 0%;
        z-index: 9999;
    }

    .event-image {
        max-height: 800px;
        max-width: fit-content;
        object-fit: cover;
        width: 100%;
        border-radius: 12px;
    }


    img.img-fluid {
        border-radius: 12px;
    }

    .container.mt-5 {
        margin-top: 0 !important;
    }

    .text-truncate {
        max-width: 10px;
        /* Kamu bisa sesuaikan lebar ini */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

</html>