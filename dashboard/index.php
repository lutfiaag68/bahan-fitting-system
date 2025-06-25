<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard -Wikhy Rumah Jahit </title>
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
            min-height: 100vh;
            background-image: linear-gradient(135deg, var(--primary-light) 10%, var(--white) 100%);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 2rem;
        }

        h2 {
            color: var(--primary-dark);
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .menu-item {
            background-color: var(--white);
            padding: 1.5rem;
            border-radius: 15px;
            text-decoration: none;
            color: var(--primary-dark);
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .menu-item i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(255, 105, 180, 0.2);
            background-color: var(--primary-color);
            color: var(--white);
        }

        .menu-item:hover i {
            color: var(--white);
        }

        .btn-logout {
            background-color: #ff4444;
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: fit-content;
            margin: 0 auto;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #ff1111;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 68, 68, 0.3);
        }

        .welcome-message {
            background-color: var(--white);
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="welcome-message">
            <h2><i class="fas fa-user-circle"></i> Selamat datang, <?php echo $_SESSION['nama']; ?>!</h2>
        </div>
        <div class="menu-grid">
            <a href="../form/pemesanan.php" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Pemesanan Bahan</span>
            </a>
            <a href="../form/fitting.php" class="menu-item">
                <i class="fas fa-ruler"></i>
                <span>Booking Fitting</span>
            </a>
            <a href="../riwayat/pemesanan.php" class="menu-item">
                <i class="fas fa-history"></i>
                <span>Riwayat Pemesanan</span>
            </a>
            <a href="../riwayat/fitting.php" class="menu-item">
                <i class="fas fa-calendar-check"></i>
                <span>Riwayat Fitting</span>
            </a>
        </div>
        <a href="../auth/logout.php" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</body>

</html>