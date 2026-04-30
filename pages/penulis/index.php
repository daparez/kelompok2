<?php
include '../../konek.php';

$result = $konek->query("SELECT * FROM penulis ORDER BY id DESC");
?>

<h2>Data Penulis</h2>
<a href="create.php">+ Tambah Data</a>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Alamat</th>
        <th>Tgl Lahir</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['tgl_lahir'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>