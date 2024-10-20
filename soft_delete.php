<?php
include_once("koneksi.php");

// Cek apakah 'id' ada di parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Cek apakah $id adalah angka valid sebelum digunakan di query
    if (is_numeric($id)) {
        // Update is_deleted menjadi 1 (soft delete)
        $delete = mysqli_query($con, "UPDATE registrasi SET is_deleted = 1 WHERE id = $id");

        if ($delete) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='kelola_peserta.php';</script>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($con);
        }
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='admin_dashboard.php';</script>";
}
?>
