
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Seminar</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        button[name="back-button"] {
            left: 20px;
            bottom: 20px;
            position: absolute;
            background-color: #009473;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Formulir Pendaftaran Seminar</h1>
    <form action="tambah_peserta.php" method="post">
        <div class="form-group">
            <table width="60%" border="0">
                <tr>
                    <td>Email</td>
                    <td><input name="email" type="email" id="email" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input name="nama" type="text" id="nama" required></td>
                </tr>
                <tr>
                    <td>Institusi</td>
                    <td><input name="institusi" type="text" id="institusi" required></td>
                </tr>
                <tr>
                    <td>Negara</td>
                    <td><input name="negara" type="text" id="negara" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea name="alamat" id="alamat"></textarea></td>
                </tr>
            </table>
            <div class="button-group">
                <button type="submit">Daftar</button>
                <button type="reset">Batal</button>
            </div>
        </div>
    </form>
    <form action="admin_dashboard.php" method="POST">
        <button name="back-button">Kembali ke Dashboard</button>
    </form>
</div>
</body>
</html>

<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $institusi = mysqli_real_escape_string($con, $_POST['institusi']);
    $negara = mysqli_real_escape_string($con, $_POST['negara']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    
    $checkEmail = mysqli_query($con, "SELECT * FROM registrasi WHERE email='$email'");

    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>
                alert('Email sudah terdaftar! Gunakan email yang berbeda.');
                window.history.back(); // Mengembalikan ke halaman sebelumnya
              </script>";
    } else {
    // Query untuk memasukkan data ke tabel registrasi
        $result = mysqli_query($con, "INSERT INTO registrasi (email, nama, institusi, negara, alamat) 
            VALUES ('$email', '$nama', '$institusi', '$negara', '$alamat')");
        
        // Cek apakah query berhasil dijalankan
        if ($result) {
            echo"<script>alert('Pendaftaran berhasil!')</script>";
        } else {
            $error_message = mysqli_error($con);
            echo "<script>
                    alert('Terjadi kesalahan: $error_message');
                </script>";
        }
    }
}
?>
