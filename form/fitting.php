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
    <title>Form Booking Fitting - Wikhy Rumah Jahit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFF0F5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.5);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #FF1493;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 35px;
            color: #FF69B4;
        }

        .form-control {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #FFB6C1;
            border-radius: 8px;
            font-size: 0.9em;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #FF1493;
            box-shadow: 0 0 5px rgba(255, 20, 147, 0.3);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.9em;
        }

        .btn i {
            margin-right: 8px;
        }

        button.btn {
            background: #FF69B4;
            color: white;
        }

        button.btn:hover {
            background: #FF1493;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #FFB6C1;
            color: #FF1493;
        }

        .btn-secondary:hover {
            background: #FFC0CB;
            transform: translateY(-2px);
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

        .container {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-calendar-check"></i> Form Booking Fitting</h2>
        <form action="../proses/simpan_fitting.php" method="POST">
            <div class="form-group">
                <label><i class="far fa-calendar-alt"></i> Tanggal Fitting:</label>
                <input type="date" name="tanggal_fitting" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="far fa-clock"></i> Jam Fitting:</label>
                <input type="time" name="jam_fitting" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-tshirt"></i> Jenis Pakaian:</label>
                <select name="jenis_pakaian" class="form-control" required>
                    <option value="">Pilih Jenis Pakaian</option>
                    <option value="Gaun Pengantin">Gaun Pengantin</option>
                    <option value="Jas Pengantin">Jas Pengantin</option>
                    <option value="Kebaya">Kebaya</option>
                    <option value="Beskap">Beskap</option>
                    <option value="Gaun Pesta">Gaun Pesta</option>
                    <option value="Jas Formal">Jas Formal</option>
                    <option value="Kemeja">Kemeja</option>
                    <option value="Dress">Dress</option>
                    <option value="Blazer">Blazer</option>
                    <option value="Rok">Rok</option>
                    <option value="Celana">Celana</option>
                </select>
            </div>
            <div class="form-group">
                <label><i class="fas fa-users"></i> Jumlah Orang:</label>
                <input type="number" name="jumlah_orang" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-comment-alt"></i> Catatan:</label>
                <textarea name="catatan" class="form-control" rows="4"></textarea>
            </div>
            <div class="btn-group">
                <button type="submit" name="submit" class="btn">
                    <i class="fas fa-calendar-check"></i> Booking Fitting
                </button>
                <a href="../dashboard/index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</body>

</html>