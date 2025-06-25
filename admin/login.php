<?php
session_start();
require_once('../config/koneksi.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        $error = "Error database: " . mysqli_error($koneksi);
    } else if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wikhy Rumah Jahit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFF0F5;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.5s ease;
        }

        h2 {
            color: #FF1493;
            text-align: center;
            margin-bottom: 25px;
            font-size: 2em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .alert-danger {
            background: rgba(255, 105, 180, 0.2);
            border-left: 4px solid #FF1493;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #FF1493;
            font-size: 0.9em;
            display: flex;
            align-items: center;
            gap: 10px;
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
            left: 12px;
            top: 38px;
            color: #FF69B4;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #FFB6C1;
            border-radius: 25px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #FF1493;
            box-shadow: 0 0 8px rgba(255, 20, 147, 0.3);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #FF69B4;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
        }

        .btn:hover {
            background: #FF1493;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 20, 147, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .alert-danger {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-user-shield"></i> Login Admin</h2>
        <?php if (isset($error)) echo "<div class='alert-danger'><i class='fas fa-exclamation-circle'></i>$error</div>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Username:</label>
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>
            <button type="submit" name="login" class="btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
    </div>
</body>

</html>