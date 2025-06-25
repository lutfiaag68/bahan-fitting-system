<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: pemesanan.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if (isset($_POST['update'])) {
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $query = "UPDATE pemesanan_bahan SET status = '$status' WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pemesanan.php?status=updated");
        exit();
    }
}

$query = "SELECT p.*, u.nama as nama_pelanggan 
          FROM pemesanan_bahan p 
          JOIN users u ON p.user_id = u.id 
          WHERE p.id = '$id'";
$result = mysqli_query($koneksi, $query);
$pemesanan = mysqli_fetch_assoc($result);

if (!$pemesanan) {
    header("Location: pemesanan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Pemesanan - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF69B4;
            --primary-light: #FFB6C1;
            --primary-dark: #FF1493;
            --white: #FFFFFF;
            --gray-light: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FFE5EE 0%, #FFF0F5 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(255, 105, 180, 0.1);
        }

        h1 {
            color: var(--primary-dark);
            text-align: center;
            font-size: 1.8em;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        nav a {
            background: white;
            color: var(--primary-dark);
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            border: 1px solid var(--primary-light);
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background: var(--primary-light);
            color: white;
            transform: translateY(-2px);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9em;
        }

        .form-group i {
            color: var(--primary-color);
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--primary-light);
            border-radius: 8px;
            font-size: 0.9em;
            background-color: var(--gray-light);
            color: #555;
        }

        input[readonly],
        textarea[readonly] {
            background-color: var(--gray-light);
            border: 1px solid #ddd;
        }

        select {
            background-color: white;
            cursor: pointer;
        }

        select:focus {
            border-color: var(--primary-dark);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.1);
        }

        button,
        .button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9em;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin: 5px;
        }

        button:hover,
        .button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .button.secondary {
            background: #6c757d;
        }

        .button.secondary:hover {
            background: #5a6268;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-edit"></i> Edit Status Pemesanan</h1>

        <nav>
            <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="pemesanan.php"><i class="fas fa-shopping-cart"></i> Kelola Pemesanan</a>
            <a href="fitting.php"><i class="fas fa-ruler"></i> Kelola Fitting</a>
        </nav>

        <div class="form-group">
            <label><i class="fas fa-user"></i> Nama Pelanggan:</label>
            <input type="text" value="<?php echo htmlspecialchars($pemesanan['nama_pelanggan']); ?>" readonly>
        </div>

        <div class="form-group">
            <label><i class="fas fa-tshirt"></i> Jenis Bahan:</label>
            <input type="text" value="<?php echo htmlspecialchars($pemesanan['jenis_bahan']); ?>" readonly>
        </div>

        <div class="form-group">
            <label><i class="fas fa-palette"></i> Warna:</label>
            <input type="text" value="<?php echo htmlspecialchars($pemesanan['warna']); ?>" readonly>
        </div>

        <div class="form-group">
            <label><i class="fas fa-calculator"></i> Jumlah:</label>
            <input type="text"
                value="<?php echo htmlspecialchars($pemesanan['jumlah']); ?> <?php echo htmlspecialchars($pemesanan['satuan']); ?>"
                readonly>
        </div>

        <div class="form-group">
            <label><i class="fas fa-sticky-note"></i> Catatan:</label>
            <textarea readonly><?php echo htmlspecialchars($pemesanan['catatan']); ?></textarea>
        </div>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-info-circle"></i> Update Status:</label>
                <select name="status" required>
                    <option value="pending" <?php echo $pemesanan['status'] == 'pending' ? 'selected' : ''; ?>>⏳ Pending
                    </option>
                    <option value="diproses" <?php echo $pemesanan['status'] == 'diproses' ? 'selected' : ''; ?>>🔄
                        Diproses</option>
                    <option value="selesai" <?php echo $pemesanan['status'] == 'selesai' ? 'selected' : ''; ?>>✅ Selesai
                    </option>
                    <option value="dibatalkan" <?php echo $pemesanan['status'] == 'dibatalkan' ? 'selected' : ''; ?>>❌
                        Dibatalkan</option>
                </select>
            </div>

            <div style="text-align: center;">
                <button type="submit" name="update" class="button">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="pemesanan.php" class="button secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</body>

</html>