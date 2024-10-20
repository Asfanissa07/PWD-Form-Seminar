<?php
session_start();
include_once("koneksi.php");

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

// Query untuk menampilkan data pendaftar yang belum dihapus
$result_active = mysqli_query($con, "SELECT * FROM registrasi WHERE is_deleted = 0");

// Query untuk menampilkan data yang telah dihapus (soft deleted)
$result_deleted = mysqli_query($con, "SELECT * FROM registrasi WHERE is_deleted = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        button[name='edit']{
            background-color: #e7a036;
        }
        button[name='delete']{
            background-color: #dd085e;
        }
        button[name='restore']{
            background-color: #2069d8;
        }
        button[name='remove']{
            background-color: #dd085e;
        }
        button[name='back']{
            margin-top: 20px;
            background-color: #009473;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Bagian untuk menampilkan data pendaftar aktif -->
        <h2>Data Pendaftar Aktif</h2>
        <?php if (mysqli_num_rows($result_active) > 0) { ?>
            <table border='1'>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Institusi</th>
                    <th>Negara</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result_active)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['institusi']; ?></td>
                        <td><?php echo $row['negara']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td>
                            <form action="edit.php" method="GET" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button name="edit" type="submit">Edit</button>
                            </form>
                            <form action="soft_delete.php" method="GET" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button name="delete" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>Tidak ada data pendaftar aktif.</p>
        <?php } ?>

        <!-- Bagian untuk menampilkan data pendaftar yang sudah dihapus -->
        <h2>Data Pendaftar yang Telah Dihapus</h2>
        <?php if (mysqli_num_rows($result_deleted) > 0) { ?>
            <table border='1'>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Institusi</th>
                    <th>Negara</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result_deleted)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['institusi']; ?></td>
                        <td><?php echo $row['negara']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td>
                            <form action="restore.php" method="GET" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button name="restore" type="submit">Restore</button>
                            </form>
                            <form action="remove_data.php" method="GET" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button name="remove" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else echo "<p>Tidak ada data pendaftar yang dihapus.</p>"?>
        <form action="admin_dashboard.php" method="POST">
            <button name="back">Kembali ke Dashboard</button>
        </form>
    </div>
</body>
</html>
