<?php
$query = mysqli_query($konek, "
SELECT 
    p.*, a.nama, a.kelas
FROM peminjaman p
JOIN anggota a ON p.id_anggota = a.id
ORDER BY p.id DESC
");
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Laporan Peminjaman</h4>

    <!-- tombol print -->
    <a href="?page=laporan&aksi=print" target="_blank" class="btn btn-success mb-3">
      Print PDF
    </a>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Kembali</th>
            <th>Status</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($d = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $d['nama']; ?></td>
          <td><?= $d['kelas']; ?></td>

          <td>
            <?php
            $detail = mysqli_query($konek, "
              SELECT b.judul, dp.jumlah
              FROM detail_peminjaman dp
              JOIN buku b ON dp.id_buku = b.id
              WHERE dp.id_peminjaman = '{$d['id']}'
            ");

            while($b = mysqli_fetch_assoc($detail)){
              echo "- {$b['judul']} ({$b['jumlah']})<br>";
            }
            ?>
          </td>

          <td><?= $d['tanggal_pinjam']; ?></td>
          <td><?= $d['tanggal_kembali']; ?></td>
          <td><?= $d['status']; ?></td>
          <td>Rp <?= number_format($d['denda']); ?></td>
        </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>

  </div>
</div>