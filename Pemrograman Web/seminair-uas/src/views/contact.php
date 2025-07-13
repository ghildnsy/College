<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Bootstrap CSS & Icons -->
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/main.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <title>Contact Us | Seminair Education</title>
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
            <h1 class="display-5 fw-bold">Contact Us</h1>
            <p class="lead">Mengedukasi, Menginspirasi, dan Menghubungkan Melalui Seminar Berkualitas</p>
        </div>
    </section>

    <div class="container my-5 px-4">
        <!-- Contact Us Section -->
        <section class="py-5 px-3 px-md-5" style="background: linear-gradient(145deg, #0f172a, #1e293b); border-radius: 20px; box-shadow: 0 0 30px rgba(0,0,0,0.5);">
            <div class="container">

                <div class="row g-5 align-items-stretch">
                    <!-- Form -->
                    <div class="col-lg-6 d-flex">
                        <div class="p-4 p-md-5 rounded-4 shadow-lg w-100"
                            style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); transition: 0.3s;">
                            <form class="h-100 d-flex flex-column justify-content-between" onsubmit="sendToWhatsApp(event)">
                                <div>
                                    <div class="mb-4">
                                        <label class="form-label text-white">Nama</label>
                                        <input id="nama" type="text" class="form-control bg-transparent text-white border border-secondary" required placeholder="Nama Anda">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-white">Email</label>
                                        <input id="email" type="email" class="form-control bg-transparent text-white border border-secondary" required placeholder="email@example.com">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-white">Pesan</label>
                                        <textarea id="pesan" class="form-control bg-transparent text-white border border-secondary" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm mt-2">Kirim Pesan</button>
                            </form>

                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-6 d-flex flex-column justify-content-between text-white">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope-fill fs-4 text-info me-3"></i>
                                <span>support@seminair.id</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone-fill fs-4 text-info me-3"></i>
                                <span>+62 896-8111-7903</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-geo-alt-fill fs-4 text-info me-3"></i>
                                <span>Jl. Inspirasi No. 10, Jakarta</span>
                            </div>
                        </div>
                        <div class="rounded-4 overflow-hidden shadow-sm flex-grow-1"
                            style="border: 1px solid rgba(255, 255, 255, 0.1);">
                            <iframe
                                src="https://www.google.com/maps?q=Universitas+Pembangunan+Nasional+Veteran+Jawa+Timur&output=embed"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>



    <!-- Footer -->
    <?php include_once '../Components/footer.php'; ?>

    <!-- Script -->
    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/script.js"></script>


</body>

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

    .card-img-top {
        height: 250px;
        object-fit: cover;
    }

    .form-control:focus {
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        border-color: #0d6efd;
    }
</style>

</html>