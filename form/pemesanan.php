<?php
session_start();
require_once('../config/koneksi.php');

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
    <title>Form Pemesanan Bahan - Wikhy Rumah Jahit</title>
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
            max-width: 800px;
            margin: 40px auto;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.15);
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

        h2 {
            color: var(--primary-dark);
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 38px;
            color: var(--primary-color);
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 0.8rem 0.8rem 2.5rem;
            border: 2px solid #eee;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
            outline: none;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23FF69B4' viewBox='0 0 16 16'%3E%3Cpath d='M8 11l-4-4h8l-4 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 10px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-shopping-cart"></i> Form Pemesanan Bahan</h2>
        <form action="../proses/simpan_pemesanan.php" method="POST">
            <div class="form-group">
                <label>Jenis Bahan:</label>
                <i class="fas fa-tshirt"></i>
                <select name="jenis_bahan" class="form-control" required>
                    <option value="">Pilih Jenis Bahan</option>
                    <option value="Katun">Katun</option>
                    <option value="Satin">Satin</option>
                    <option value="Sutra">Sutra</option>
                    <option value="Chiffon">Chiffon</option>
                    <option value="Linen">Linen</option>
                    <option value="Denim">Denim</option>
                    <option value="Velvet">Velvet</option>
                    <option value="Organza">Organza</option>
                    <option value="Taffeta">Taffeta</option>
                    <option value="Tulle">Tulle</option>
                </select>
            </div>
            <div class="form-group">
                <label>Warna:</label>
                <i class="fas fa-palette"></i>
                <input type="text" name="warna" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jumlah:</label>
                <i class="fas fa-calculator"></i>
                <input type="number" step="0.1" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Satuan:</label>
                <i class="fas fa-ruler"></i>
                <select name="satuan" class="form-control" required>
                    <option value="meter">Meter</option>
                    <option value="yard">Yard</option>
                    <option value="roll">Roll</option>
                </select>
            </div>
            <div class="form-group">
                <label>Catatan:</label>
                <i class="fas fa-sticky-note"></i>
                <textarea name="catatan" class="form-control" rows="4"></textarea>
            </div>
            <div class="button-group">
                <button type="submit" name="submit" class="btn">
                    <i class="fas fa-check"></i> Pesan Bahan
                </button>
                <a href="../dashboard/index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</body>

</html>