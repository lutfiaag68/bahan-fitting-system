<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Mengambil data pemesanan terbaru
$query_pemesanan = "SELECT p.*, u.nama as nama_pelanggan 
                   FROM pemesanan_bahan p 
                   JOIN users u ON p.user_id = u.id 
                   ORDER BY p.tanggal_pesan DESC LIMIT 5";
$pemesanan = mysqli_query($koneksi, $query_pemesanan);

// Mengambil data booking fitting terbaru
$query_fitting = "SELECT f.*, u.nama as nama_pelanggan 
                 FROM booking_fitting f 
                 JOIN users u ON f.user_id = u.id 
                 ORDER BY f.tanggal_booking DESC LIMIT 5";
$fitting = mysqli_query($koneksi, $query_fitting);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Wikhy Rumah Jahit</title>
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

        h2 {
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .admin-menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .dashboard-section {
            background-color: var(--white);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .dashboard-section h3 {
            color: var(--primary-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 15px;
            text-align: left;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .table tr:hover {
            background-color: #f8f9fa;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 0.9em;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h2>
        <div class="admin-menu">
            <a href="pemesanan.php" class="btn"><i class="fas fa-shopping-cart"></i> Kelola Pemesanan</a>
            <a href="fitting.php" class="btn"><i class="fas fa-ruler"></i> Kelola Fitting</a>
            <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <div class="dashboard-section">
            <h3><i class="fas fa-shopping-bag"></i> Pemesanan Bahan Terbaru</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th><i class="far fa-calendar-alt"></i> Tanggal</th>
                        <th><i class="fas fa-user"></i> Pelanggan</th>
                        <th><i class="fas fa-cloth"></i> Jenis Bahan</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($pemesanan)): ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_pesan'])); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_bahan']); ?></td>
                            <td>
                                <span class="status-badge">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_pemesanan.php?id=<?php echo $row['id']; ?>" class="btn btn-small">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="dashboard-section">
            <h3><i class="fas fa-calendar-check"></i> Booking Fitting Terbaru</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th><i class="far fa-calendar-alt"></i> Tanggal Booking</th>
                        <th><i class="fas fa-user"></i> Pelanggan</th>
                        <th><i class="fas fa-clock"></i> Jadwal Fitting</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($fitting)): ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_booking'])); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_fitting'] . ' ' . $row['jam_fitting'])); ?>
                            </td>
                            <td>
                                <span class="status-badge">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_fitting.php?id=<?php echo $row['id']; ?>" class="btn btn-small">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>