<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Bootstrap CSS (via node_modules) -->
    <link
        rel="stylesheet"
        href="/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">


    <!-- Favicon -->
    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />

    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/main.css" />

    <!-- BSB Brain Hero Component -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-overlay/bsb-overlay.css" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-btn-size/bsb-btn-size.css" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/heroes/hero-6/assets/css/hero-6.css" />

    <!-- animation -->

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Seminair Education</title>
</head>

<body>
    <!-- Progress bar -->
    <div id="scrollProgress"></div>

    <!-- Navbar Component-->
    <?php include './src/Components/navbar.php'; ?>

    <!-- Hero Component -->
    <?php include './src/Components/Home/heroComponent.php'; ?>


    <!-- main content -->

    <!-- best events -->
    <section class="container mb-3 mt-5">

        <div class="mb-5 text-center">
            <h2>🚀 Trending Collection Event</h2>
            <p class="text-white-50">Checkout our weekly updated trending collection of top seminars.</p>
        </div>


        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5" data-aos="fade-up">
            <?php include './src/Components/Home/trendingCollection.php'; ?>
        </div>
    </section>



    <!-- why choose us -->
    <section style="position: relative; background: radial-gradient(circle at top left, #1e3a8a, #000); padding: 100px 20px; overflow: hidden; color: white;">
        <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between" data-aos="fade-up">

            <!-- Video Section -->
            <div class="mx-auto w-100" style="max-width: 500px; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.5); border: 2px solid rgba(255,255,255,0.2);">
                <div style="position: relative; width: 100%; padding-top: 56.25%;"> <!-- 16:9 aspect ratio -->
                    <iframe
                        src="https://www.youtube.com/embed/IE0FinThii4?si=y8TubjkBYWJxL7_W&controls=0"
                        title="Seminar Video"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; filter: brightness(0.95); border: none;">
                    </iframe>
                </div>
                <div style="position: absolute; top: 10px; left: 10px; background: rgba(255,255,255,0.1); padding: 5px 12px; border-radius: 8px; font-size: 0.8rem;">📺 Replay</div>
            </div>

            <!-- Text Section -->
            <div class="text-lg-start text-center mt-5 mt-lg-0 ms-lg-5">
                <h1 class="fw-bold mb-4 fs-3 fs-md-2 fs-lg-1">
                    Experience the Best Moments of Our Seminar
                </h1>
                <p class="fs-6 fs-md-5" style="max-width: 500px;">
                    Watch the exclusive highlights and get inspired by top minds. Don't miss your chance to be part of something big — again and again.
                </p>
                <a href="./src/views/events.php" class="button-gradient">
                    🚀 Join Our Next Seminar
                </a>

            </div>

        </div>

        <!-- Optional background element -->
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.1), transparent); border-radius: 50%; filter: blur(60px);"></div>
    </section>

    <!-- footer -->
    <?php include './src/Components/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- animation -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Custom Script -->
    <script src="./js/script.js"></script>



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

    .navbar-nav {
        gap: 1rem;
    }

    /* Background and cinematic style */
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: white;
        font-family: 'Montserrat', sans-serif;
        scroll-behavior: smooth;
    }

    /* Section cinematic style */
    section {
        padding: 80px 20px;
        position: relative;
        z-index: 1;
    }

    section::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -100px;

        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08), transparent);
        border-radius: 50%;
        filter: blur(100px);
        z-index: -1;
    }



    h2 {
        font-weight: 800;
        font-size: 2.4rem;
        background: linear-gradient(to right, #8b5cf6, #ec4899);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }


    .button-gradient {
        margin-top: 25px;
        display: inline-block;
        padding: 12px 28px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        border-radius: 40px;
        color: white;
        font-size: 0.9rem;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.6);
        transition: transform 0.3s ease;
    }

    .button-gradient:hover {
        transform: scale(1.05);
    }

    /* Card / Event item style */
    .card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        color: white;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    /* Button Glow */
    a.btn-glow {
        display: inline-block;
        padding: 12px 28px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        border-radius: 40px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.6);
        transition: transform 0.3s ease;
    }

    a.btn-glow:hover {
        transform: scale(1.05);
    }

    @media (min-width: 768px) {
        .button-gradient {
            font-size: 1.25rem;
            /* desktop */
        }
    }
</style>

</html>