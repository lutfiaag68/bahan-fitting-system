<?php
session_start();
require_once('config/koneksi.php');

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wikhy Rumah Jahit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #FF69B4;
            --primary-light: #FFB6C1;
            --primary-dark: #FF1493;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 20px 0;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .nav-menu {
            background-color: var(--primary-dark);
            padding: 15px 0;
        }

        .nav-menu .container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background-color: var(--white);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3em;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .feature-title {
            color: var(--primary-dark);
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        .auth-buttons {
            text-align: center;
            margin-top: 40px;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 10px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header class="header">
        <h1><i class="fas fa-tshirt"></i> Wikhy Rumah Jahit</h1>
    </header>

    <nav class="nav-menu">
        <div class="container">
            <?php if ($is_logged_in): ?>
                <a href="dashboard/index.php" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="form/pemesanan.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Pesan Bahan</a>
                <a href="form/fitting.php" class="nav-link"><i class="fas fa-ruler"></i> Booking Fitting</a>
                <a href="riwayat/pemesanan.php" class="nav-link"><i class="fas fa-history"></i> Riwayat Pemesanan</a>
                <a href="riwayat/fitting.php" class="nav-link"><i class="fas fa-calendar-check"></i> Riwayat Fitting</a>
                <a href="auth/logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="main-content">
        <?php if (!$is_logged_in): ?>
            <div class="auth-buttons">
                <a href="auth/login.php" class="btn"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="auth/register.php" class="btn"><i class="fas fa-user-plus"></i> Register</a>
            </div>
        <?php endif; ?>

        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="feature-title">Pemesanan Bahan</h3>
                <p class="feature-description">Pesan berbagai jenis bahan berkualitas untuk kebutuhan Anda dengan mudah
                    dan cepat.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-ruler"></i>
                </div>
                <h3 class="feature-title">Booking Fitting</h3>
                <p class="feature-description">Atur jadwal fitting sesuai kenyamanan Anda untuk hasil yang maksimal.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="feature-title">Riwayat Transaksi</h3>
                <p class="feature-description">Pantau semua riwayat pemesanan bahan dan booking fitting Anda dengan
                    mudah.</p>
            </div>
        </div>
    </main>
</body>

</html>