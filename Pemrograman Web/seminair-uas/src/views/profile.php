<?php
include("../../config.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil user ID dari session
$userId = $_SESSION['user']['id'];

// Query untuk ambil data terbaru pengguna dari DB
$stmt = $db->prepare("SELECT id_pengguna as id, nama_pengguna as name, email_pengguna as email, instansi_pengguna as instansi FROM pengguna WHERE id_pengguna = ?");

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Update session user agar selalu sinkron dengan DB
    $_SESSION['user'] = $user;
} else {
    // User tidak ditemukan, logout
    session_destroy();
    header("Location: ../login.php");
    exit();
}

// Tangani proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $field = $_POST['edit'];
    $value = '';

    switch ($field) {
        case 'name':
            $value = $_POST['name'];
            $query = "UPDATE pengguna SET nama_pengguna = ? WHERE id_pengguna = ?";
            break;
        case 'email':
            $value = $_POST['email'];
            $query = "UPDATE pengguna SET email_pengguna = ? WHERE id_pengguna = ?";
            break;
        case 'instansi':
            $value = $_POST['instansi'];
            $query = "UPDATE pengguna SET instansi_pengguna = ? WHERE id_pengguna = ?";
            break;
        case 'password':
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];

            // Ambil password lama dari database
            $stmtPwd = $db->prepare("SELECT password_pengguna FROM pengguna WHERE id_pengguna = ?");
            $stmtPwd->bind_param("i", $userId);
            $stmtPwd->execute();
            $resultPwd = $stmtPwd->get_result();

            if ($resultPwd->num_rows === 1) {
                $row = $resultPwd->fetch_assoc();
                $hashedPassword = $row['password_pengguna'];

                if (password_verify($oldPassword, $hashedPassword)) {
                    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePwd = $db->prepare("UPDATE pengguna SET password_pengguna = ? WHERE id_pengguna = ?");
                    $updatePwd->bind_param("si", $newHashedPassword, $userId);

                    if ($updatePwd->execute()) {
                        $success = "Password berhasil diperbarui.";
                    } else {
                        $error = "Gagal memperbarui password.";
                    }
                    $updatePwd->close();
                } else {
                    $error = "Password lama salah.";
                }
            } else {
                $error = "Gagal mengambil data pengguna.";
            }

            $stmtPwd->close();
            break;

        default:
            $query = '';
    }

    if (!empty($query)) {
        $stmtUpdate = $db->prepare($query);
        $stmtUpdate->bind_param("si", $value, $userId);

        if ($stmtUpdate->execute()) {
            $success = "Berhasil memperbarui $field.";
        } else {
            $error = "Gagal memperbarui $field.";
        }

        $stmtUpdate->close();

        // Refresh session data agar langsung update di tampilan
        $stmt = $db->prepare("SELECT id_pengguna as id, nama_pengguna as name, email_pengguna as email, instansi_pengguna as instansi FROM pengguna WHERE id_pengguna = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;
        }
    }
}


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


    <!-- animation -->

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Profile Pengguna</title>
</head>

<body>

    <?php include '../Components/navbar.php'; ?>



    <section class="container mb-5" data-aos="fade-up" style="margin-top: 150px;">


        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-4 shadow" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                    <h3 class="text-center mb-4" style="color: white;">👤 Profil Pengguna</h3>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <!-- nama -->

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <label class="form-label text-white mb-1">Nama</label>
                            <div class="text-white fw-semibold"><?= htmlspecialchars($user['name']) ?></div>
                        </div>
                        <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editNameModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>

                    <!-- email -->

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <label class="form-label text-white mb-1">Email</label>
                            <div class="text-white fw-semibold"><?= htmlspecialchars($user['email']) ?></div>
                        </div>
                        <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>

                    <!-- instansi -->

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <label class="form-label text-white mb-1">Instansi</label>
                            <div class="text-white fw-semibold"><?= htmlspecialchars($user['instansi']) ?></div>
                        </div>
                        <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editInstansiModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>

                    <!-- password -->

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <label class="form-label text-white mb-1">Password</label>
                            <div class="text-white fw-semibold">********</div>
                        </div>
                        <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>


                </div>


                <!-- Edit Nama -->
                <div class="modal fade" id="editNameModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Nama</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" value="name" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Email -->
                <div class="modal fade" id="editEmailModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Email</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" value="email" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Instansi -->
                <div class="modal fade" id="editInstansiModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Instansi</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="instansi" class="form-control" value="<?= htmlspecialchars($user['instansi']) ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" value="instansi" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Ubah Password -->
                <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form method="POST" class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Password</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Password Lama</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" value="password" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include '../Components/footer.php'; ?>

</body>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<style>
    /* Background and cinematic style */
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: white;
        font-family: 'Montserrat', sans-serif;
        scroll-behavior: smooth;
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
</style>

</html>