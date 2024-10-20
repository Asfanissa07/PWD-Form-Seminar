<?php
include_once("koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM registrasi WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $institusi = mysqli_real_escape_string($con, $_POST['institusi']);
    $negara = mysqli_real_escape_string($con, $_POST['negara']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);

    $update = mysqli_query($con, "UPDATE registrasi SET email='$email', nama='$nama', institusi='$institusi', negara='$negara', alamat='$alamat' WHERE id=$id");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        .custom-button {
            color: white; /* Warna teks */
            border: none; /* Menghilangkan border */
            padding: 10px 20px; /* Spasi di dalam tombol */
            cursor: pointer; /* Menunjukkan bahwa ini adalah tombol yang bisa diklik */
            border-radius: 10px; /* Membuat sudut tombol menjadi bulat */
            font-size: 15px;
            left: 20px;
            bottom: 20px;
            position: absolute;
            background-color: #009473;
        }
        button[type='reset']{
            background-color: #c8135e;
        }
        button[type='submit']{
            background-color: #535bc3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="admin_dashboard.php" method="POST">
            <button class="custom-button">Kembali ke Dashboard</button>
        </form>
        <h1>Edit Data Pendaftaran</h1>
        <form method="POST">
            <div class="form-group"></div>
                <table width="60%" border="0">
                            <tr>
                                <td>Email</td>
                                <td><input name="email" type="email" id="email" value="<?php echo $row['email']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><input name="nama" type="text" id="nama" value="<?php echo $row['nama']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Institusi</td>
                                <td><input name="institusi" type="text" id="institusi" value="<?php echo $row['institusi']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Negara</td>
                                <td><input name="negara" type="text" id="negara" value="<?php echo $row['negara']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><textarea name="alamat" id="alamat"><?php echo $row['alamat']; ?></textarea></td>
                            </tr>
                    </table>
                    <div class="button-group">
                        <button name="submit" type="submit" >Update</button>
                        <button name="batal" type="reset" >Batal</button>
                    </div>
            </div>
        </form>
    </div>
</body>
</html>
