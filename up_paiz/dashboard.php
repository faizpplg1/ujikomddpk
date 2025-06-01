<?php
session_start();
include "service/database.php";


// Cek apakah sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Tambah User
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    header("Location: dashboard.php");
}

// Update User
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'] !== '' ? ", password = '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "'" : '';
    mysqli_query($db, "UPDATE users SET username='$username' $password WHERE id=$id");
    header("Location: dashboard.php");
}

// Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($db, "DELETE FROM users WHERE id=$id");
    header("Location: dashboard.php");
}

// Ambil data user untuk edit
$userEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
    $userEdit = mysqli_fetch_assoc($res);
}
?>

<h3>Selamat datang, <?= $_SESSION['username'] ?>!</h3>


<hr>

<h4><?= $userEdit ? "Edit User" : "Tambah User" ?></h4>
<form method="POST">
    <input type="hidden" name="id" value="<?= $userEdit['id'] ?? '' ?>">
    Username: <input type="text" name="username" value="<?= $userEdit['username'] ?? '' ?>" required><br>
    Password: <input type="password" name="password" <?= $userEdit ? '' : 'required' ?>><br>
    <button type="submit" name="<?= $userEdit ? 'update' : 'tambah' ?>">
        <?= $userEdit ? 'Update' : 'Tambah' ?>
    </button>
</form>

<hr>

<h4>Daftar User</h4>
<table border="1" cellpadding="8">
    <tr>
        <th>No</th><th>Username</th><th>Aksi</th>
    </tr>
    <?php
    $result = mysqli_query($db, "SELECT * FROM users");
    $no = 1;
    while ($user = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>$no</td>
            <td>{$user['username']}</td>
            <td>
                <a class='btn btn-edit' href='dashboard.php?edit={$user['id']}'>Edit</a>
<a class='btn btn-delete' href='dashboard.php?hapus={$user['id']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>

            </td>
        </tr>";
        $no++;
    }
    ?>
</table>

  

 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        :root {
            --bg-color: #1e1e2f;
            --text-color: #f0f0f0;
            --card-bg: #2c2c3c;
            --border-color: #444;
            --primary: #4da3ff;
            --success: #4caf50;
            --danger: #ff4d4d;
        }

        body.light-mode {
            --bg-color: #f4f4f4;
            --text-color: #111;
            --card-bg: #fff;
            --border-color: #ccc;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h3, h4 {
            color: var(--text-color);
        }

        button, .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-edit {
            background-color: var(--primary);
            color: white;
        }

        .btn-delete {
            background-color: var(--danger);
            color: white;
        }

        .btn-logout {
            background-color: #888;
            color: white;
            margin-top: 30px;
        }

        .btn-toggle {
            background-color: var(--primary);
            color: white;
            float: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: var(--card-bg);
            color: var(--text-color);
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid var(--border-color);
        }

        table th {
            background-color: #3a3a4a;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: none;
            border-radius: 5px;
            background: #444;
            color: #fff;
        }

        body.light-mode input[type="text"],
        body.light-mode input[type="password"] {
            background: #fff;
            color: #000;
            border: 1px solid #ccc;
        }

        form {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            width: 400px;
        }

        hr {
            border: 1px solid var(--border-color);
        }
    </style>
    <script>
        function toggleMode() {
            document.body.classList.toggle('light-mode');
        }
    </script>
</head>
<body>
<div class="container">
    <button class="btn-toggle" onclick="toggleMode()">🌙 / ☀️</button>

<a href="logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
 <?php include "layout/footer.html" ?>
