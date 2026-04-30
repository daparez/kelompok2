<?php
include '../../konek.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($konek, "DELETE FROM anggota WHERE id=$id");
    header("Location: index.php");
}
?>

<h2>Data Anggota</h2>
<a href="create.php">Tambah Data</a>
<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($konek, "SELECT * FROM anggota");
while ($d = mysqli_fetch_array($data)) {
?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $d['nama']; ?></td>
        <td><?= $d['alamat']; ?></td>
        <td><?= $d['no_hp']; ?></td>
        <td>
            <a href="edit.php?id=<?= $d['id']; ?>">Edit</a>
            <a href="index.php?hapus=<?= $d['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
        </td>
    </tr>
<?php } ?>
</table>