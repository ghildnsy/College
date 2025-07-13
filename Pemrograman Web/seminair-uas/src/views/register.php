<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register - Seminair Education</title>

    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="./css/main.css" />
</head>

<body>
    <!-- show alert status user register  -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>


    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Register Account Seminair</h2>


            <form action="../Controller/RegisterController.php" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control bg-transparent text-white" id="nama" name="nama" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-transparent text-white" id="email" name="email" required />
                </div>
                <div class="mb-3">
                    <label for="instansi" class="form-label">Instansi</label>
                    <input type="text" class="form-control bg-transparent text-white" id="instansi" name="instansi" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control bg-transparent text-white" id="password" name="password" required />
                        <span class="input-group-text bg-transparent border-white text-white" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn w-100 button-gradient">Sign Up</button>
            </form>
            <p class="mt-4 text-left text-white-50" style="font-size: 0.9rem;">
                Sudah punya akun?
                <a href="login.php" class="text-decoration-none" style="color: #ec4899; font-weight: 600;">Login</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            toggleIcon.classList.toggle("bi-eye");
            toggleIcon.classList.toggle("bi-eye-slash");
        }
    </script>
</body>

<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Montserrat', sans-serif;
        color: white;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        color: white;
    }

    h2 {
        font-weight: 800;
        font-size: 2rem;
        background: linear-gradient(to right, #8b5cf6, #ec4899);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .button-gradient {
        padding: 12px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        border-radius: 40px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        border: none;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.6);
        transition: transform 0.3s ease;
    }

    .button-gradient:hover {
        transform: scale(1.05);
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .input-group-text {
        border-left: none;
    }

    .form-control:focus {
        box-shadow: none;
    }
</style>

</html>