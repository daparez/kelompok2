<?php
include 'konek.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($konek, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    if (password_verify($password, $data['password'])) {

        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];

        header("Location: dashboard.php");
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}