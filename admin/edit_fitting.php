<?php
session_start();
require_once('../config/koneksi.php');

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: fitting.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $query = "UPDATE booking_fitting SET status = '$status' WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: fitting.php");
        exit();
    }
}

// Ambil data booking fitting
$query = "SELECT bf.*, u.nama FROM booking_fitting bf 
         JOIN users u ON bf.user_id = u.id 
         WHERE bf.id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: fitting.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Booking Fitting - Admin</title>
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

            nav {
                flex-direction: column;
            }

            nav a {
                width: 100%;
                justify-content: center;
            }

            button,
            .button {
                width: 100%;
                justify-content: center;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-edit"></i> Edit Status Booking Fitting</h1>

        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="pemesanan.php"><i class="fas fa-shopping-bag"></i> Kelola Pemesanan</a>
            <a href="fitting.php"><i class="fas fa-tshirt"></i> Kelola Fitting</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>

        <form method="POST">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Nama Pelanggan:</label>
                <input type="text" value="<?php echo htmlspecialchars($data['nama']); ?>" readonly>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar-alt"></i> Tanggal Booking:</label>
                <input type="text" value="<?php echo htmlspecialchars($data['tanggal_booking']); ?>" readonly>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Jam:</label>
                <input type="text"
                    value="<?php echo isset($data['jam_fitting']) ? htmlspecialchars($data['jam_fitting']) : ''; ?>"
                    readonly>
            </div>

            <div class="form-group">
                <label><i class="fas fa-comment-alt"></i> Catatan:</label>
                <textarea readonly><?php echo htmlspecialchars($data['catatan']); ?></textarea>
            </div>

            <div class="form-group">
                <label><i class="fas fa-tasks"></i> Status:</label>
                <select name="status" required>
                    <option value="Menunggu" <?php echo $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>🕒 Menunggu
                    </option>
                    <option value="Dikonfirmasi" <?php echo $data['status'] == 'Dikonfirmasi' ? 'selected' : ''; ?>>✅
                        Dikonfirmasi</option>
                    <option value="Selesai" <?php echo $data['status'] == 'Selesai' ? 'selected' : ''; ?>>🎉 Selesai
                    </option>
                    <option value="Dibatalkan" <?php echo $data['status'] == 'Dibatalkan' ? 'selected' : ''; ?>>❌
                        Dibatalkan</option>
                </select>
            </div>

            <button type="submit" name="update"><i class="fas fa-save"></i> Simpan Perubahan</button>
            <a href="fitting.php" class="button secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</body>

</html>