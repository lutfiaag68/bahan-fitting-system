<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT p.*, u.nama as nama_pelanggan 
          FROM pemesanan_bahan p 
          JOIN users u ON p.user_id = u.id 
          ORDER BY p.tanggal_pesan DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan - Admin</title>
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
            font-size: 2.2em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .table-container {
            background-color: var(--white);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .table tr:hover {
            background-color: #f8f9fa;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
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

        .btn-small {
            padding: 8px 16px;
            font-size: 0.9em;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: 500;
            background-color: var(--primary-light);
            color: var(--primary-dark);
        }

        .back-btn {
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>
            <i class="fas fa-shopping-cart"></i>
            Kelola Pemesanan Bahan
        </h2>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th><i class="far fa-calendar-alt"></i> Tanggal</th>
                        <th><i class="fas fa-user"></i> Pelanggan</th>
                        <th><i class="fas fa-tshirt"></i> Jenis Bahan</th>
                        <th><i class="fas fa-palette"></i> Warna</th>
                        <th><i class="fas fa-box"></i> Jumlah</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_pesan'])); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_bahan']); ?></td>
                            <td><?php echo htmlspecialchars($row['warna']); ?></td>
                            <td><?php echo $row['jumlah'] . ' ' . $row['satuan']; ?></td>
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

        <a href="index.php" class="btn back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</body>

</html>