<?php
session_start();
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hard-coded login for admin, replace with a database query in real applications
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="form-container">
        <h1>Login Admin</h1>
        <form action="index.php" method="POST">
        <div class="form-group">
            <table width="60%">
                <tr>
                    <td><input type="text" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" required></td>
                </tr>
            </table>
            <div class="button-group">
                <button name="submit" type="submit" >Login</button>
                <button name="batal" type="reset" >Batal</button>
            </div>
        </form>
    </div>
</body>
</html>
