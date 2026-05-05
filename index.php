<?php 
require_once 'konek.php';

// routing dulu
$page = $_GET['page'] ?? 'dashboard';
$aksi = $_GET['aksi'] ?? 'index';

// whitelist
$allowed_page = ['dashboard', 'anggota', 'buku', 'kategori', 'penulis', 'peminjaman', 'laporan'];

if (!in_array($page, $allowed_page)) {
    $page = 'dashboard';
}

// HAPUS BUKU
// =======================
if ($page == 'buku' && $aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($konek, "DELETE FROM buku WHERE id='$id'");
    echo "<script>alert('Dihapus');location='?page=buku';</script>";
    exit;
}

// hapus anggota
if ($page == 'anggota' && $aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($konek, "DELETE FROM anggota WHERE id='$id'");
    echo "<script>alert('Dihapus');location='?page=anggota';</script>";
    exit;
}

// hapus kategori
if ($page == 'kategori' && $aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($konek, "DELETE FROM kategori WHERE id='$id'");
    echo "<script>alert('Dihapus');location='?page=kategori';</script>";
    exit;
}

$file = "pages/$page/$aksi.php";

if (!file_exists($file)) {
    $file = "pages/$page/index.php";
}

$detail = mysqli_query($konek, "
    SELECT * FROM detail_peminjaman WHERE id_peminjaman='$id'
");

while($d = mysqli_fetch_assoc($detail)){
    mysqli_query($konek, "
        UPDATE buku SET stok = stok + {$d['jumlah']}
        WHERE id='{$d['id_buku']}'
    ");
}

// =======================
// LOGIKA PENGEMBALIAN
// =======================
if ($page == 'peminjaman' && $aksi == 'kembali') {

    $id = $_GET['id'];

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
        alert('Denda: Rp $denda');
        window.location='?page=peminjaman';
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