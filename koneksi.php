<?php
    $host="localhost";
    $username="root";
    $password="";
    $databasename="db_seminar";

    $con=mysqli_connect($host,$username,$password,$databasename);

    if (!$con) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
?>