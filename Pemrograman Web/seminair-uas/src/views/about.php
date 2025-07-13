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

    <!-- animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <title>About Us | Seminair Education</title>
</head>

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
</style>

<body style="font-family: 'Montserrat', sans-serif; background-color: #f8fafc;">

    <!-- Progress bar -->
    <div id="scrollProgress"></div>

    <!-- Navbar -->
    <?php include '../Components/navbar.php'; ?>


    <!-- Hero Section -->
    <section class="mt-5 hero-section text-white d-flex align-items-center" style="height: 400px; background: url('/assets/img/audience.avif') center/cover no-repeat; position: relative;">
        <div style="background-color: rgba(0,0,0,0.6); position:absolute; top:0; left:0; width:100%; height:100%;"></div>
        <div class="container text-center position-relative z-2">
            <h1 class="display-5 fw-bold">Tentang Kami</h1>
            <p class="lead">Mengedukasi, Menginspirasi, dan Menghubungkan Melalui Seminar Berkualitas</p>
        </div>
    </section>

    <div class="px-4" style="background-color: #0f172a;">

        <!-- Visi & Misi -->
        <section class="py-5 container" style="color: #f1f5f9;">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-white">Visi & Misi</h2>
                    <p class="text-secondary">Kami percaya bahwa edukasi berkualitas dapat membuka jalan menuju masa depan yang lebih cerah dan kolaboratif.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 rounded shadow-sm h-100 border-start border-4 border-primary" style="background-color: #1e293b;">
                            <h4 class="fw-semibold text-primary mb-3"><i class="bi bi-eye-fill me-2"></i>Visi</h4>
                            <p class="text-light">Menjadi pelopor platform edukasi berbasis seminar yang menginspirasi, memberdayakan, dan membuka peluang kolaborasi tanpa batas di seluruh Indonesia.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 rounded shadow-sm h-100 border-start border-4 border-success" style="background-color: #1e293b;">
                            <h4 class="fw-semibold text-success mb-3"><i class="bi bi-bullseye me-2"></i>Misi</h4>
                            <ul class="list-unstyled text-light mb-0">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Menyediakan seminar dan webinar inovatif dengan tema terkini dan narasumber terpercaya.</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Memperluas jangkauan edukasi hingga ke pelosok negeri melalui media digital.</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Membangun komunitas pembelajar aktif yang kolaboratif dan terus berkembang.</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Mengintegrasikan teknologi untuk menciptakan pengalaman belajar yang menarik dan efektif.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nilai-nilai -->
        <section class="py-5 rounded container" style="background-color: #1e293b; color: #f1f5f9;">
            <div class="container">
                <h2 class="fw-bold text-center mb-4 text-white">Nilai-nilai Kami</h2>
                <div class="row text-center g-4" data-aos="fade-up">
                    <div class="col-md-4">
                        <div class="p-4 shadow-sm rounded" style="background-color: #0F172A;">
                            <i class="bi bi-lightbulb display-5 text-warning mb-3"></i>
                            <h5 class="fw-semibold text-white">Inovatif</h5>
                            <p class="text-light">Kami terus berinovasi untuk menyajikan materi dan pengalaman belajar yang relevan dengan perkembangan zaman.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 shadow-sm rounded" style="background-color: #0F172A;">
                            <i class="bi bi-people display-5 text-primary mb-3"></i>
                            <h5 class="fw-semibold text-white">Kolaboratif</h5>
                            <p class="text-light">Kami percaya kekuatan kolaborasi antara peserta, pembicara, dan komunitas untuk tumbuh bersama.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 shadow-sm rounded" style="background-color: #0F172A;">
                            <i class="bi bi-award display-5 text-success mb-3"></i>
                            <h5 class="fw-semibold text-white">Berkualitas</h5>
                            <p class="text-light">Kami berkomitmen menyajikan pengalaman edukatif yang bermutu tinggi dengan standar profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan -->
        <section class="py-5" style="background-color: #0f172a; color: #f1f5f9;">
            <div class="container text-center">
                <h2 class="fw-bold mb-4 text-white">Kenapa Memilih Kami?</h2>
                <p class="text-secondary mb-4">Lebih dari sekadar seminar — kami menghadirkan ekosistem pembelajaran yang holistik.</p>
                <div class="row justify-content-center g-4" data-aos="fade-up">
                    <div class="col-md-4">
                        <div class="shadow-sm rounded p-4 h-100" style="background-color: #1e293b;">
                            <i class="bi bi-globe2 fs-2 text-info mb-2"></i>
                            <h5 class="fw-semibold text-white">Akses Nasional</h5>
                            <p class="text-light">Kami menjangkau peserta dari seluruh Indonesia tanpa batasan geografis.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow-sm rounded p-4 h-100" style="background-color: #1e293b;">
                            <i class="bi bi-clock-history fs-2 text-danger mb-2"></i>
                            <h5 class="fw-semibold text-white">Fleksibel</h5>
                            <p class="text-light">Webinar dapat diakses ulang, memungkinkan peserta belajar sesuai waktu mereka.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow-sm rounded p-4 h-100" style="background-color: #1e293b;">
                            <i class="bi bi-graph-up fs-2 text-success mb-2"></i>
                            <h5 class="fw-semibold text-white">Terbukti Efektif</h5>
                            <p class="text-light">Ratusan peserta telah merasakan manfaat nyata dari seminar yang kami selenggarakan.</p>
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


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="/js/script.js"></script>


</body>

</html>