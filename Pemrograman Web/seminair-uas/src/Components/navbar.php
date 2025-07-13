<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm fixed-top" style="backdrop-filter: blur(12px); background-color: rgba(15, 23, 42, 0.7); border-bottom: 1px solid rgba(255,255,255,0.1);">
    <div class="container py-2 px-4">
        <a class="navbar-brand" href="/">
            <img src="/assets/icon/seminair.png" width="110" alt="Seminair Logo" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample"
            aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarExample">
            <ul class="navbar-nav mx-auto gap-4">
                <?php
                $current = basename($_SERVER['PHP_SELF']);
                function isActive($page)
                {
                    global $current;
                    return $current == $page ? 'active-nav' : '';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('index.php') ?>" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('events.php') ?>" href="/src/views/events.php">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('about.php') ?>" href="/src/views/about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('contact.php') ?>" href="/src/views/contact.php">Contact Us</a>
                </li>
            </ul>

            <!-- button login will change with user -->
            <div class="mt-3 d-block ">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-light d-flex align-items-center justify-content-between gap-3 rounded px-3 py-2 shadow-sm"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: #f8fafc;">
                            <img src="/assets/icon/avatar-default.png" alt="User Avatar" width="28" height="28"
                                class="rounded-circle border border-white" />
                            <span style="font-weight: 600;"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                            <i class="bi bi-chevron-down mt-1"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow user-dropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="/src/views/profile.php">
                                    <i class="bi bi-person-circle"></i> Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="/src/Controller/LogoutController.php">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/src/views/login.php" class="btn btn-primary">Login</a>
                <?php endif; ?>
            </div>



        </div>
    </div>
</nav>

<style>
    .navbar {
        z-index: 1000;
    }

    .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.85);
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: #fff;
        text-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
    }

    .active-nav {
        font-weight: 700;
        background: linear-gradient(to right, #8b5cf6, #ec4899);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }


    .input-group input:focus {
        box-shadow: none;
    }

    .navbar-toggler {
        color: white;
    }

    .user-dropdown {
        background: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    /* Item dasar */
    .user-dropdown .dropdown-item {
        color: #f1f5f9;
        transition: background 0.2s ease, color 0.2s ease;
        padding: 10px 16px;
    }

    /* Hover state */
    .user-dropdown .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #ffffff;
    }

    /* Active state */
    .user-dropdown .dropdown-item:active {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffffff;
    }

    /* Divider */
    .user-dropdown .dropdown-divider {
        border-color: rgba(255, 255, 255, 0.15);
    }
</style>