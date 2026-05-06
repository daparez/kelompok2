<?php
$query = mysqli_query($konek, "SELECT * FROM anggota ORDER BY id DESC");
$no = 1;


?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Data Siswa</h4>

    <a href="?page=anggota&aksi=create" class="btn btn-primary mb-3">
      Tambah Siswa
    </a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th width="150">Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['kelas']; ?></td>
          <td>
            <a href="?page=anggota&aksi=edit&id=<?= $row['id']; ?>" 
               class="btn btn-warning btn-sm">Edit</a>

            <a href="?page=anggota&aksi=hapus&id=<?= $row['id']; ?>" 
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