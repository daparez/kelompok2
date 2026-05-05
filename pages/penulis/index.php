<?php
$query = mysqli_query($konek, "SELECT * FROM penulis ORDER BY id DESC");
if (!isset($konek)) {
    die("Akses harus lewat index.php");
}
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Data Penulis</h4>

    <a href="?page=penulis&aksi=create" class="btn btn-primary mb-3">
      Tambah Penulis
    </a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Alamat</th>
            <th>Tgl Lahir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['deskripsi']; ?></td>
          <td><?= $row['alamat']; ?></td>
          <td><?= $row['tgl_lahir']; ?></td>
          <td>
            <a href="?page=penulis&aksi=edit&id=<?= $row['id']; ?>" 
               class="btn btn-warning btn-sm">Edit</a>

            <a href="?page=penulis&aksi=hapus&id=<?= $row['id']; ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin hapus?')">
               Hapus
            </a>
          </td>
        </tr>
        <?php endwhile; ?>

        </tbody>
      </table>
    </div>

  </div>
</div>