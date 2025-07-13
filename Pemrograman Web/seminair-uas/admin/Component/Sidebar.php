<?php
// get parameter 'page' from url & set default to dashboard
$current_page = $_GET['page'] ?? 'dashboard';
?>

<div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">
        <img src="/assets/icon/seminair.png" class="img-fluid mb-3" alt="Seminair Logo"
            style="width: 150px; height: auto; display: block; margin: 0 auto;" />
    </div>
    <div class="list-group list-group-flush">
        <a href="../Routes/IndexAdmin.php?page=dashboard" class="list-group-item list-group-item-action <?= $current_page === 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="../Routes/IndexAdmin.php?page=dataevent" class="list-group-item list-group-item-action <?= $current_page === 'dataevent' ? 'active' : '' ?>">
            <i class="bi bi-calendar-event"></i> Data Event
        </a>
        <a href="../Routes/IndexAdmin.php?page=datapeserta" class="list-group-item list-group-item-action <?= $current_page === 'datapeserta' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Data Peserta
        </a>
        <a href="../Routes/IndexAdmin.php?page=datakategori" class="list-group-item list-group-item-action <?= $current_page === 'datakategori' ? 'active' : '' ?>">
            <i class="bi bi-tags"></i> Data Kategori
        </a>
        <a href="../Routes/IndexAdmin.php?page=dataadmin" class="list-group-item list-group-item-action <?= $current_page === 'dataadmin' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i> Data Admin
        </a>
    </div>
</div>

<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f8f9fa;
    }

    #wrapper {
        display: flex;
        min-height: 100vh;
    }

    #sidebar-wrapper {
        min-width: 250px;
        max-width: 250px;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
        transition: margin 0.25s ease-out;
        padding-top: 20px;
    }

    #page-content-wrapper {
        flex-grow: 1;
        padding: 20px;
        background-color: #fff;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.05);
    }

    #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        font-weight: 700;
        color: #ec4899;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 15px;
    }

    #sidebar-wrapper .list-group {
        width: 100%;
    }

    #sidebar-wrapper .list-group-item {
        background-color: transparent;
        color: rgba(255, 255, 255, 0.8);
        border: none;
        padding: 12px 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
        display: flex;
        align-items: center;
    }

    #sidebar-wrapper .list-group-item i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    #sidebar-wrapper .list-group-item.active,
    #sidebar-wrapper .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    @media (max-width: 768px) {
        #sidebar-wrapper {
            margin-left: -250px;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            width: 100%;
        }
    }

    .navbar-custom {
        background-color: #ffffff;
        border-bottom: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 10px 20px;
        margin-bottom: 20px;
    }

    .navbar-toggler {
        border: none;
        color: #001f3f;
    }

    .navbar-toggler:focus {
        box-shadow: none;
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
</style>