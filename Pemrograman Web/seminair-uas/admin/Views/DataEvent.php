<!-- component -->
<?php include_once '../Routes/authentication.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Data Event</title>

    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />

    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="./css/main.css" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


</head>

<body>

    <div class="d-flex" id="wrapper">
        <?php include_once '../Component/Sidebar.php'; ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <span class="user-info me-3">Selamat datang, <?= htmlspecialchars($_SESSION['admin']['username'] ?? 'Admin') ?></span>

                    <div>
                        <a href="../Routes/logout.php" class="logout-link">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 class="mt-4">Data Event</h1>
                <p>Ini adalah area data event Anda. Anda bisa menambahkan, mengedit, menghapus data event di sini.</p>
                <div class="table-responsive shadow px-3 py-2 mb-5 bg-body rounded">
                    <table id="event" class="table table-striped " style="width:100%">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="ms-2 fw-semibold mt-3">Tabel Daftar Event</p>
                            <!-- Tambah event -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahEventModal">Tambah Event</button>
                            <?php include '../Component/ModalAddEvent.php' ?>
                        </div>

                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Penyelenggara</th>
                                <th>Deskripsi</th>
                                <th>Tipe</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($events)) : ?>
                                <?php foreach ($events as $event) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($event['kategori_event']) ?></td>
                                        <td class="text-capitalize text-truncate" style="max-width: 150px; white-space: nowrap;">
                                            <?= htmlspecialchars($event['nama_event']) ?>
                                        </td>
                                        <td>
                                            <img src="/assets/img/events/<?= htmlspecialchars($event['gambar_event']) ?>" width="100" height="auto" alt="Gambar Event">
                                        </td>
                                        <td class="text-capitalize">
                                            <?= date('m/d/Y H:i:s', strtotime($event['tgl_event'])) ?>
                                        </td>
                                        <td class="text-capitalize"><?= htmlspecialchars($event['lokasi_event']) ?></td>
                                        <td class="text-capitalize"><?= htmlspecialchars($event['penyelenggara_event']) ?></td>
                                        <td class="text-capitalize text-truncate" style="max-width: 150px; white-space: nowrap;">
                                            <?= htmlspecialchars($event['deskripsi_event']) ?>
                                        </td>
                                        <td class="text-capitalize"><?= htmlspecialchars($event['tipe_event']) ?></td>
                                        <td class="text-capitalize"><?= htmlspecialchars($event['harga_event']) ?></td>
                                        <td>

                                            <!-- edit button -->
                                            <button class="btn btn-warning btn-sm btn-edit-delete" data-bs-toggle="modal" data-bs-target="#editEventModal<?= $event['id_event'] ?>">Edit</button>

                                            <!-- delete button -->
                                            <button class="btn btn-danger btn-sm btn-edit-delete" data-bs-toggle="modal" data-bs-target="#deleteEventModal<?= $event['id_event'] ?>">Delete</button>

                                        </td>
                                    </tr>

                                    <!-- Modal Edit Event -->
                                    <?php include '../Component/ModalEditEvent.php' ?>
                                    <!-- Modal Delete Event -->
                                    <?php include '../Component/ModalDeleteEvent.php' ?>



                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada event.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        new DataTable('#event', {

            // pageLength: 5,
            // lengthMenu: [10],
            // paging: true,
            // info: true,
            // searching: true

        });
    </script>
</body>

<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f8f9fa;
    }

    #wrapper {
        display: flex;
        min-height: 100vh;
    }


    .navbar-custom {
        background-color: #ffffff;
        border-bottom: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 10px 20px;
        margin-bottom: 20px;

    }


    .user-info {
        font-weight: 500;
        color: #333;
    }

    .logout-link {
        color: #dc3545;
        font-weight: 500;
        text-decoration: none;
    }

    .logout-link:hover {
        text-decoration: underline;
    }

    .btn-edit-delete {
        width: 80px;
        height: 30px;
        padding: 0;
        font-size: 14px;
        margin-bottom: 5px;
    }
</style>

</html>