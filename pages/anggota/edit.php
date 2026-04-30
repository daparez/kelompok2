<?php
include '../../konek.php';

$id = $_GET['id'];
$data = mysqli_query($konek, "SELECT * FROM anggota WHERE id=$id");
$d = mysqli_fetch_array($data);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];

    mysqli_query($konek, "UPDATE anggota SET 
        nama='$nama',
        alamat='$alamat',
        no_hp='$no_hp'
        WHERE id=$id");

    header("Location: index.php");
}
?>

<h2>Edit Data</h2>
<form method="post">
    Nama: <br>
    <input type="text" name="nama" value="<?= $d['nama']; ?>"><br>
    Alamat: <br>
    <textarea name="alamat"><?= $d['alamat']; ?></textarea><br>
    No HP: <br>
    <input type="text" name="no_hp" value="<?= $d['no_hp']; ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>