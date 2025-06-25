<?php
session_start();
require_once('../config/koneksi.php');

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data booking fitting
$query = "SELECT bf.*, u.nama FROM booking_fitting bf 
         JOIN users u ON bf.user_id = u.id 
         ORDER BY bf.tanggal_booking DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Booking Fitting - Admin</title>
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
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        h1 {
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        nav a {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        nav a:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav a.active {
            background-color: var(--primary-dark);
        }

        .table-container {
            background-color: var(--white);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: none;
        }

        th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9em;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: 500;
            background-color: var(--primary-light);
            color: var(--primary-dark);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            <i class="fas fa-calendar-check"></i>
            Kelola Booking Fitting
        </h1>
        <nav>
            <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="pemesanan.php"><i class="fas fa-shopping-cart"></i> Kelola Pemesanan</a>
            <a href="fitting.php" class="active"><i class="fas fa-ruler"></i> Kelola Fitting</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> No</th>
                        <th><i class="fas fa-user"></i> Nama Pelanggan</th>
                        <th><i class="far fa-calendar-alt"></i> Tanggal Booking</th>
                        <th><i class="far fa-clock"></i> Jam</th>
                        <th><i class="fas fa-sticky-note"></i> Catatan</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['tanggal_booking'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_fitting']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['catatan']) . "</td>";
                        echo "<td><span class='status-badge'>" . htmlspecialchars($row['status']) . "</span></td>";
                        echo "<td>";
                        echo "<a href='edit_fitting.php?id=" . $row['id'] . "' class='btn'><i class='fas fa-edit'></i> Edit</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>