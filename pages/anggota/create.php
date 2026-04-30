<?php
include '../../konek.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];

    mysqli_query($konek, "INSERT INTO anggota (nama, alamat, no_hp) 
                         VALUES ('$nama', '$alamat', '$no_hp')");
    header("Location: index.php");
}
?>

<h2>Tambah Data</h2>
<form method="post">
    Nama: <br>
    <input type="text" name="nama"><br>
    Alamat: <br>
    <textarea name="alamat"></textarea><br>
    No HP: <br>
    <input type="text" name="no_hp"><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>