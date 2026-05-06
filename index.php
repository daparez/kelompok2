<?php 
session_start();
require_once 'konek.php';

// proteksi login
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// routing
$page = $_GET['page'] ?? 'dashboard';
$aksi = $_GET['aksi'] ?? 'index';

// whitelist
$allowed_page = ['dashboard', 'anggota', 'buku', 'kategori', 'penulis', 'peminjaman', 'laporan'];

if (!in_array($page, $allowed_page)) {
    $page = 'dashboard';
}

// =======================
// HAPUS DATA (SWEET ALERT)
// =======================
if ($aksi == 'hapus' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // ===== HAPUS BUKU =====
    if ($page == 'buku') {

        mysqli_query($konek, "DELETE FROM detail_peminjaman WHERE id_buku='$id'");
        mysqli_query($konek, "DELETE FROM buku WHERE id='$id'");

        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Dihapus',
          text: 'Buku berhasil dihapus!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          window.location='?page=buku';
        });
        </script>";
        exit;
    }

    // ===== HAPUS ANGGOTA =====
    if ($page == 'anggota') {

        $cek = mysqli_query($konek, "SELECT * FROM peminjaman WHERE id_anggota='$id'");

        if(mysqli_num_rows($cek) > 0){
            echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'Anggota masih punya riwayat peminjaman!'
            }).then(() => {
              window.location='?page=anggota';
            });
            </script>";
            exit;
        }

        mysqli_query($konek, "DELETE FROM anggota WHERE id='$id'");

        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Dihapus',
          text: 'Anggota berhasil dihapus!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          window.location='?page=anggota';
        });
        </script>";
        exit;
    }

    // ===== HAPUS KATEGORI =====
    if ($page == 'kategori') {

        mysqli_query($konek, "DELETE FROM kategori WHERE id='$id'");

        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Dihapus',
          text: 'Kategori berhasil dihapus!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          window.location='?page=kategori';
        });
        </script>";
        exit;
    }

    // ===== HAPUS PENULIS =====
    if ($page == 'penulis') {

        mysqli_query($konek, "DELETE FROM penulis WHERE id='$id'");

        echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Dihapus',
          text: 'Penulis berhasil dihapus!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          window.location='?page=penulis';
        });
        </script>";
        exit;
    }
}

// =======================
// LOGIKA PENGEMBALIAN
// =======================
if ($page == 'peminjaman' && $aksi == 'kembali' && isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $data = mysqli_fetch_assoc(mysqli_query($konek, "
        SELECT * FROM peminjaman WHERE id='$id'
    "));

    $tgl_kembali_real = date('Y-m-d');
    $batas = $data['tanggal_kembali'];

    $telat = (strtotime($tgl_kembali_real) - strtotime($batas)) / (60*60*24);
    $denda = ($telat > 0) ? $telat * 3000 : 0;

    mysqli_query($konek, "
        UPDATE peminjaman SET
        status='dikembalikan',
        tanggal_dikembalikan='$tgl_kembali_real',
        denda='$denda'
        WHERE id='$id'
    ");

    $detail = mysqli_query($konek, "
        SELECT * FROM detail_peminjaman WHERE id_peminjaman='$id'
    ");

    while($d = mysqli_fetch_assoc($detail)){
        mysqli_query($konek, "
            UPDATE buku SET stok = stok + {$d['jumlah']}
            WHERE id='{$d['id_buku']}'
        ");
    }

    echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: 'Buku dikembalikan. Denda: Rp $denda'
    }).then(() => {
      window.location='?page=peminjaman';
    });
    </script>";
    exit;
}
?>

<?php include 'layout/header.php'; ?>

<div class="container-fluid page-body-wrapper">

  <?php include 'layout/sidebar.php'; ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <?php
      $file = "pages/$page/$aksi.php";

      if (!file_exists($file)) {
          $file = "pages/$page/index.php";
      }

      if (file_exists($file)) {
          include $file;
      } else {
          echo "<h4>Halaman tidak ditemukan</h4>";
      }
      ?>

    </div>
  </div>

</div>

<?php include 'layout/footer.php'; ?>