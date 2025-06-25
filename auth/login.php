<?php
session_start();
require_once('../config/koneksi.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        header("Location: ../dashboard/index.php");
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wikhy Rumah Jahit</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(135deg, var(--primary-light) 10%, var(--white) 100%);
        }

        .container {
            background-color: var(--white);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.15);
            width: 100%;
            max-width: 400px;
            transform: translateY(-20px);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(0);
            }

            to {
                opacity: 1;
                transform: translateY(-20px);
            }
        }

        h2 {
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.2rem;
            font-weight: 600;
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

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            animation: shake 0.5s ease;
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
            background-color: #ffe6e6;
            color: #ff4444;
            border: 1px solid #ffcccc;
        }

        p {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        p a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        p a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'><i class='fas fa-exclamation-circle'></i> $error</div>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Email:</label>
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
        <p>Belum punya akun? <a href="register.php"><i class="fas fa-user-plus"></i> Daftar disini</a></p>
    </div>
</body>

</html>