<?php
include_once("koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengembalikan data yang sudah dihapus (restore)
    $restore = mysqli_query($con, "UPDATE registrasi SET is_deleted = 0 WHERE id = $id");

    if ($restore) {
        echo "<script>alert('Data berhasil dipulihkan!'); window.location.href='kelola_peserta.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($con);
    }
}
?>
