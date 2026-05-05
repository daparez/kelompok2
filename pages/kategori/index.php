<?php
$query = mysqli_query($konek, "
SELECT *
FROM kategori
ORDER BY id DESC
");
if(!$query){
  die("Query error: " . mysqli_error($konek));
}

?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Data Kategori</h4>

    <a href="?page=kategori&aksi=create" class="btn btn-primary mb-3">
      Tambah Kategori
    </a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($d = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $d['Nama_kategori']; ?></td>
          <td>
            <a href="?page=kategori&aksi=edit&id=<?= $d['id']; ?>" 
               class="btn btn-warning btn-sm">Edit</a>

            <a href="?page=kategori&aksi=hapus&id=<?= $d['id']; ?>" 
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