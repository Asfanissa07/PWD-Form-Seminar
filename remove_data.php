<?php
// include database connection file
include_once("koneksi.php");
// Cek apakah 'id' ada di parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Cek apakah $id adalah angka valid sebelum digunakan di query
    if (is_numeric($id)) {
        $result = mysqli_query($con, "DELETE FROM registrasi WHERE id=$id");

        if ($result) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='kelola_peserta.php';</script>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($con);
        }
    }
}
?>