<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout Berhasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-box {
            background: white;
            padding: 30px 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .logout-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .logout-box a {
            display: inline-block;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .logout-box a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logout-box">
        <h2>kamu keluar dari halaman dashboard</h2>
        <a href="login.php">Kembali ke Login</a>
    </div>
</body>
</html>
