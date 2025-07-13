<!-- component -->
<?php include_once '../Routes/authentication.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Data Admin</title>

    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="./css/main.css" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* Custom CSS untuk Sidebar dan Layout */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            /* Latar belakang halaman dashboard */
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Top Navbar for toggle button */
        .navbar-custom {
            background-color: #ffffff;
            /* Latar belakang navbar putih */
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
            margin-bottom: 20px;
            /* Jarak antara navbar dan konten */
        }


        .user-info {
            font-weight: 500;
            color: #333;
        }

        .logout-link {
            color: #dc3545;
            /* Merah untuk logout */
            font-weight: 500;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
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
                <h1 class="mt-4">Data Admin</h1>
                <p>Ini adalah area data Admin Anda. Anda bisa melihat Admin di sini.</p>


                <div class="table-responsive shadow px-2 mb-5 bg-body rounded">
                    <table id="example" class="table table-striped " style="width:100%">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="ms-2 fw-semibold mt-3">Tabel Daftar Kategori</p>


                        </div>

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Admin</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($listAdmins)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($listAdmins as $admins) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($admins['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">Tidak ada admin.</td>
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
            responsive: true
        });
    </script>
</body>

</html>