<?php
// =======================
// STATISTIK
// =======================

// total buku
$total_buku = mysqli_fetch_assoc(mysqli_query($konek, "
    SELECT COUNT(*) as total FROM buku
"))['total'];

// buku sedang dipinjam
$total_pinjam = mysqli_fetch_assoc(mysqli_query($konek, "
    SELECT COUNT(*) as total FROM peminjaman WHERE status='dipinjam'
"))['total'];

// total anggota
$total_anggota = mysqli_fetch_assoc(mysqli_query($konek, "
    SELECT COUNT(*) as total FROM anggota
"))['total'];

// total denda
$total_denda = mysqli_fetch_assoc(mysqli_query($konek, "
    SELECT SUM(denda) as total FROM peminjaman
"))['total'];

// =======================
// DATA TAMBAHAN
// =======================

// buku terbaru
$buku = mysqli_query($konek, "
    SELECT b.judul, p.nama as penulis
    FROM buku b
    LEFT JOIN penulis p ON b.id_penulis = p.id
    ORDER BY b.id DESC
    LIMIT 5
");

// peminjaman terbaru
$peminjaman = mysqli_query($konek, "
    SELECT p.*, a.nama 
    FROM peminjaman p
    LEFT JOIN anggota a ON p.id_anggota = a.id
    ORDER BY p.id DESC
    LIMIT 5
");
?>

<div class="row">

  <div class="col-md-3">
    <div class="card p-3 shadow text-center">
      <h6>Total Buku</h6>
      <h2><?= $total_buku; ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 shadow text-center">
      <h6>Dipinjam</h6>
      <h2><?= $total_pinjam; ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 shadow text-center">
      <h6>Anggota</h6>
      <h2><?= $total_anggota; ?></h2>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card p-3 shadow text-center">
      <h6>Total Denda</h6>
      <h2>Rp <?= number_format($total_denda ?? 0); ?></h2>
    </div>
  </div>

</div>

<!-- ======================= -->
<!-- BUKU TERBARU -->
<!-- ======================= -->
<div class="card mt-4 shadow">
  <div class="card-body">
    <h4 class="card-title">📚 Buku Terbaru</h4>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($d = mysqli_fetch_assoc($buku)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $d['judul']; ?></td>
          <td><?= $d['penulis'] ?? '-'; ?></td>
        </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- ======================= -->
<!-- PEMINJAMAN TERBARU -->
<!-- ======================= -->
<div class="card mt-4 shadow">
  <div class="card-body">
    <h4 class="card-title">📦 Peminjaman Terbaru</h4>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($d = mysqli_fetch_assoc($peminjaman)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $d['nama']; ?></td>
          <td><?= $d['tanggal_pinjam']; ?></td>
          <td>
            <?php if($d['status']=='dipinjam'): ?>
              <span class="badge badge-warning">Dipinjam</span>
            <?php else: ?>
              <span class="badge badge-success">Dikembalikan</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- ======================= -->
<!-- INFO TAMBAHAN -->
<!-- ======================= -->
<div class="card mt-4 shadow">
  <div class="card-body">
    <h4 class="card-title">ℹ️ Informasi</h4>

    <ul>
      <li>Total buku di sistem: <b><?= $total_buku; ?></b></li>
      <li>Buku sedang dipinjam: <b><?= $total_pinjam; ?></b></li>
      <li>Total anggota terdaftar: <b><?= $total_anggota; ?></b></li>
      <li>Total denda terkumpul: <b>Rp <?= number_format($total_denda ?? 0); ?></b></li>
    </ul>

  </div>
</div>