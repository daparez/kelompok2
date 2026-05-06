<?php
session_start();
include 'konek.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($konek, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data && password_verify($password, $data['password'])){
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data['nama'];

        header("Location: index.php?page=dashboard");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Perpustakaan</title>

  <!-- CSS TEMPLATE -->
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    body {
      background: #f4f6f9;
    }
    .login-box {
      margin-top: 100px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center login-box">
    <div class="col-md-4">
      
      <div class="card shadow">
        <div class="card-body">

          <h4 class="text-center mb-4">📚 Login Perpustakaan</h4>

          <?php if(isset($error)) : ?>
            <div class="alert alert-danger"><?= $error; ?></div>
          <?php endif; ?>

          <form method="POST">

            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary btn-block">
              Login
            </button>

          </form>

        </div>
      </div>

      <p class="text-center mt-3">© Perpustakaan 2026</p>

    </div>
  </div>
</div>

</body>
</html>