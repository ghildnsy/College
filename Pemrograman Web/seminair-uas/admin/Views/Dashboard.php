<?php
if (!isset($_SESSION['admin'])) {
    header("Location: ../Views/Login.php");
    exit;
}
include_once '../Component/StartCard.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Dashboard Admin Seminair</title>

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
                <h1 class="mt-4">Dashboard Admin</h1>
                <p>Ini adalah area konten utama Anda. Anda bisa menambahkan tabel, grafik, atau informasi lainnya di sini.</p>
                <div class="row">
                    <?php

                    // get data total from routes/IndexAdmin.php
                    statCard('Jumlah Kategori', $totalCategories);
                    statCard('Total Event', $totalEvents);
                    statCard('Admin Aktif', $totalAdmins);
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>


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

</html>