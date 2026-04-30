<?php
include 'konek.php';

$query = "SELECT * FROM peminjaman";
$result = mysqli_query($konek, $query);
?>

<h2>Data Peminjaman</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>ID Anggota</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['id_anggota']; ?></td>
        <td><?= $row['tanggal_pinjam']; ?></td>
        <td><?= $row['tanggal_kembali']; ?></td>
        <td><?= $row['status']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
            <a href="hapus.php?id=<?= $row['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>