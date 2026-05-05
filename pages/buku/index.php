<?php
$query = mysqli_query($konek, "
SELECT b.*, k.nama_kategori, p.nama
FROM buku b
LEFT JOIN kategori k ON b.id_kategori = k.id
LEFT JOIN penulis p ON b.id_penulis = p.id
ORDER BY b.id DESC
");
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Data Buku</h4>

    <a href="?page=buku&aksi=create" class="btn btn-primary mb-3">
      Tambah Buku
    </a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; while($d = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $d['judul']; ?></td>
          <td><?= $d['nama_kategori']; ?></td>
          <td><?= $d['nama']; ?></td>
          <td><?= $d['penerbit']; ?></td>
          <td><?= $d['tahun']; ?></td>
          <td><?= $d['stok']; ?></td>
          <td>
            <a href="?page=buku&aksi=edit&id=<?= $d['id']; ?>" 
               class="btn btn-warning btn-sm">Edit</a>

            <a href="?page=buku&aksi=hapus&id=<?= $d['id']; ?>" 
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