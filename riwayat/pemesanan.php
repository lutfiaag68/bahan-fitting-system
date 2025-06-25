<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM pemesanan_bahan WHERE user_id = '$user_id' ORDER BY tanggal_pesan DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Wikhy Rumah Jahit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFF0F5;
            margin: 0;
            padding: 10px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }

        h2 {
            color: #FF1493;
            text-align: center;
            margin: 10px 0;
            font-size: 1.8em;
        }

        .alert-success {
            background: rgba(255, 182, 193, 0.3);
            border-left: 4px solid #FF1493;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .order-card {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .order-info {
            margin: 4px 0;
            color: #333;
            font-size: 0.9em;
        }

        .order-info i {
            color: #FF1493;
            width: 20px;
            margin-right: 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.8em;
            background: #FF69B4;
            color: white;
            margin-top: 5px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background: #FF69B4;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.9em;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #FF1493;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-history"></i> Riwayat Pemesanan Bahan</h2>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> Pemesanan berhasil disimpan!
            </div>
        <?php endif; ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="order-card">
                <div class="order-info">
                    <i class="far fa-calendar-alt"></i>
                    <?php echo date('d/m/Y H:i', strtotime($row['tanggal_pesan'])); ?>
                </div>
                <div class="order-info">
                    <i class="fas fa-tshirt"></i>
                    <?php echo htmlspecialchars($row['jenis_bahan']); ?>
                </div>
                <div class="order-info">
                    <i class="fas fa-palette"></i>
                    <?php echo htmlspecialchars($row['warna']); ?>
                </div>
                <div class="order-info">
                    <i class="fas fa-ruler"></i>
                    <?php echo $row['jumlah'] . ' ' . $row['satuan']; ?>
                </div>
                <div class="status-badge">
                    <i class="fas fa-clock"></i>
                    <?php echo ucfirst($row['status']); ?>
                </div>
            </div>
        <?php endwhile; ?>

        <a href="../dashboard/index.php" class="btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</body>

</html>