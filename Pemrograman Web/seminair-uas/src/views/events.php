<?php include("../../config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">


    <!-- Favicon -->
    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/main.css">

    <title>Events | Seminair Education</title>
</head>

<body style="font-family: 'Montserrat', sans-serif; background-color: #f8fafc;">

    <!-- Progress bar -->
    <div id="scrollProgress"></div>

    <!-- Navbar -->
    <?php include_once '../Components/navbar.php'; ?>



    <!-- Hero Section -->
    <section class="mt-5 hero-section text-white d-flex align-items-center" style="height: 400px; background: url('/assets/img/audience.avif') center/cover no-repeat; position: relative;">
        <div style="background-color: rgba(0,0,0,0.6); position:absolute; top:0; left:0; width:100%; height:100%;"></div>
        <div class="container text-center position-relative z-2">
            <h1 class="display-5 fw-bold mb-3">Temukan Seminar & Webinar Terbaik</h1>
            <p class="lead mb-4">Tingkatkan pengetahuanmu bersama para ahli dari berbagai bidang</p>

            <!-- Search input  -->
            <div class="input-group mx-auto w-75 shadow-sm" style="max-width: 600px;">

                <!-- call search event js function -->
                <input type="text" id="searchInput" class="form-control py-2 px-3 border-0" placeholder="Cari seminar atau webinar..." oninput="searchEvent()">
                <span class="input-group-text bg-primary text-white border-0">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </section>

    <!--  Filter -->
    <div class="container mt-5 px-4">
        <div class="text-center text-xl-start">
            <p class="fw-bold mb-3 lead" style="font-size: 25px;">Browse Categories</p>
            <div class="d-flex flex-wrap justify-content-center justify-content-xl-start gap-2">
                <button onclick="filterKategori('all')" class="btn btn-outline-primary">Semua</button>
                <button onclick="filterKategori('education')" class="btn btn-outline-success">Edukasi</button>
                <button onclick="filterKategori('healthy')" class="btn btn-outline-info">Kesehatan</button>
                <button onclick="filterKategori('beauty')" class="btn btn-outline-danger">Kecantikan</button>
                <button onclick="filterKategori('best_events')" class="btn btn-outline-warning">Best Event</button>
            </div>
        </div>
    </div>



    <!-- Event Cards -->
    <div class="container my-5">
        <div class="row g-4" id="event-container">
            <?php include("../Components/Event/eventComponent.php"); ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once '../Components/footer.php'; ?>

    <!-- Scripts -->
    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/script.js"></script>

    <style>
        #scrollProgress {
            position: fixed;
            top: 0;
            left: 0;
            height: 5px;
            background-color: #0d6efd;
            width: 0%;
            z-index: 9999;
        }

        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary,
        .btn-outline-success,
        .btn-outline-info {
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        .btn-outline-success:hover {
            background-color: #198754;
            color: white;
        }

        .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: white;
        }

        #searchInput::placeholder {
            color: #999;
            font-size: 0.95rem;
        }

        .input-group-text {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .input-group-text:hover {
            background-color: #0b5ed7;
        }

        .hero-section input:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .input-group {
            border-radius: 0.5rem;
            overflow: hidden;
        }
    </style>

</body>

</html>