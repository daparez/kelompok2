<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .page-body-wrapper {
      padding-top: 0 !important;
    }

    .navbar {
      height: 60px;
      background: #fff;
      border-bottom: 1px solid #eee;
    }

    .dropdown-toggle {
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="container-scroller">

<!-- NAVBAR -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 d-flex justify-content-between align-items-center flex-row px-3 shadow-sm">
  
  <!-- KIRI -->
  <div class="navbar-brand-wrapper">
    <h4 class="mb-0">📚 Perpustakaan</h4>
  </div>

  <!-- KANAN -->
  <div class="d-flex align-items-center">

    <div class="dropdown">
      <a class="d-flex align-items-center text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        
        <i class="mdi mdi-account-circle" style="font-size: 24px;"></i>
        <span class="ml-2"><?= $_SESSION['nama']; ?></span>

      </a>

      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-account"></i> Profile
          </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item text-danger" href="logout.php">
            <i class="mdi mdi-logout"></i> Logout
          </a>
        </li>
      </ul>
    </div>

  </div>

</nav>

<div class="container-fluid page-body-wrapper">