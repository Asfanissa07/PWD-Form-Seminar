<?php
session_start();
include_once("koneksi.php");

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        button[name="kelola"]{
            background-color: #186e5b;
        }
        button[name="tambah"]{
            background-color: #48a490;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Dashboard Admin</h1>
        <table>
            <tr>
                <td><a href="kelola_peserta.php"><button name="kelola">Kelola Daftar Peserta</button></a></td>
                <td><a href="tambah_peserta.php"><button name="tambah">Tambah Peserta Baru</button></a></td>
            </tr>
        </table>
    </div>
</body>
</html>
