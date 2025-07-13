<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - Seminair Education</title>

    <link rel="icon" href="/assets/icon/seminair.png" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">

            <img src="/assets/icon/seminair.png" class="img-fluid mb-3" alt="Seminair Logo" style="width: 200px; height: auto; display: block; margin: 0 auto;" />
            <form action="../Routes/admin_login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" id="username" name="username" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required />
                        <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn w-100 button-formal-navy">Login</button>
            </form>

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
        background: linear-gradient(135deg, #e0e0e0, #f0f0f0);
        font-family: 'Montserrat', sans-serif;
        color: #333;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        color: #333;
    }

    h2 {
        font-weight: 800;
        font-size: 2rem;

        background: linear-gradient(to right, rgb(19, 2, 176), rgb(0, 5, 153), rgb(1, 5, 80));

        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .button-formal-navy {
        /* Mengganti nama kelas untuk button */
        padding: 12px;
        background: #001f3f;
        /* Warna Navy Solid */
        border-radius: 15px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        border: none;
        box-shadow: 0 0 15px rgba(0, 31, 63, 0.4);
        /* Shadow sesuai warna navy */
        transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .button-formal-navy:hover {
        transform: scale(1.03);
        /* Sedikit lebih kecil dari sebelumnya untuk kesan formal */
        background-color: #003366;
        /* Sedikit lebih terang saat hover */

        color: white;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.8) !important;
        color: #333 !important;
        border: 1px solid #ccc;
    }

    .form-control::placeholder {
        color: rgba(0, 0, 0, 0.5);
    }

    .input-group-text {
        background-color: rgba(255, 255, 255, 0.8) !important;
        border: 1px solid #ccc !important;
        border-left: none !important;
        color: #333 !important;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 31, 63, 0.25);
        /* Focus shadow disesuaikan dengan navy */
        border-color: #001f3f;
        /* Border focus warna navy */
    }

    .text-dark-50 {
        color: rgba(0, 0, 0, 0.5) !important;
    }
</style>

</html>