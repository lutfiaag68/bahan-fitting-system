<?php
session_start();
require_once('../config/koneksi.php');

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $check_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (nama, email, password, telp) VALUES ('$nama', '$email', '$password', '$telp')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: login.php");
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Wikhy Rumah jahit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        :root {
            --primary-color: #FF69B4;
            --primary-light: #FFB6C1;
            --primary-dark: #FF1493;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
            outline: none;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .alert-danger {
            background-color: #ffe6e6;
            color: #ff4444;
            border: 1px solid #ffcccc;
        }

        p {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        p a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        p a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-user-plus"></i> Register</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Nama Lengkap:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-phone"></i> No. Telepon:</label>
                <input type="text" name="telp" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
    </div>
</body>

</html>